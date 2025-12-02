@echo off
REM AllnGrow Monitoring Management Script for Windows
REM This script helps manage the monitoring stack

setlocal enabledelayedexpansion

REM Check if Docker is running
docker info >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Docker is not running. Please start Docker Desktop first.
    exit /b 1
)

REM Parse command
set COMMAND=%1
if "%COMMAND%"=="" set COMMAND=help

if "%COMMAND%"=="start" goto start
if "%COMMAND%"=="stop" goto stop
if "%COMMAND%"=="restart" goto restart
if "%COMMAND%"=="status" goto status
if "%COMMAND%"=="logs" goto logs
if "%COMMAND%"=="update" goto update
if "%COMMAND%"=="backup-grafana" goto backup_grafana
if "%COMMAND%"=="cleanup" goto cleanup
if "%COMMAND%"=="test-alert" goto test_alert
if "%COMMAND%"=="health" goto health
if "%COMMAND%"=="help" goto help
if "%COMMAND%"=="--help" goto help
if "%COMMAND%"=="-h" goto help

echo [ERROR] Unknown command: %COMMAND%
echo.
goto help

:start
echo [INFO] Starting monitoring stack...
docker-compose -f docker-compose.monitoring.yml up -d
if %errorlevel% neq 0 (
    echo [ERROR] Failed to start monitoring stack
    exit /b 1
)
echo.
echo [INFO] Waiting for services to be ready...
timeout /t 10 /nobreak >nul
echo.
echo [SUCCESS] Monitoring stack started!
echo.
echo Access URLs:
echo   - Grafana: http://localhost:3000 (admin/admin123)
echo   - Prometheus: http://localhost:9090
echo   - AlertManager: http://localhost:9093
echo   - cAdvisor: http://localhost:8080
goto end

:stop
echo [INFO] Stopping monitoring stack...
docker-compose -f docker-compose.monitoring.yml down
echo [SUCCESS] Monitoring stack stopped!
goto end

:restart
echo [INFO] Restarting monitoring stack...
docker-compose -f docker-compose.monitoring.yml restart
echo [SUCCESS] Monitoring stack restarted!
goto end

:status
echo [INFO] Monitoring stack status:
docker-compose -f docker-compose.monitoring.yml ps
goto end

:logs
set SERVICE=%2
if "%SERVICE%"=="" (
    echo [INFO] Showing all monitoring logs (Ctrl+C to exit)...
    docker-compose -f docker-compose.monitoring.yml logs -f
) else (
    echo [INFO] Showing logs for %SERVICE% (Ctrl+C to exit)...
    docker-compose -f docker-compose.monitoring.yml logs -f %SERVICE%
)
goto end

:update
echo [INFO] Updating monitoring stack...
docker-compose -f docker-compose.monitoring.yml pull
docker-compose -f docker-compose.monitoring.yml up -d
echo [SUCCESS] Monitoring stack updated!
goto end

:backup_grafana
echo [INFO] Creating backup directory...
if not exist "backups\grafana" mkdir backups\grafana

echo [INFO] Backing up Grafana data...
for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value') do set datetime=%%I
set BACKUP_FILE=grafana-backup-%datetime:~0,8%-%datetime:~8,6%.tar.gz

docker exec allngrow-grafana tar czf /tmp/grafana-backup.tar.gz /var/lib/grafana
docker cp allngrow-grafana:/tmp/grafana-backup.tar.gz backups\grafana\%BACKUP_FILE%
docker exec allngrow-grafana rm /tmp/grafana-backup.tar.gz

echo [SUCCESS] Grafana backup created: backups\grafana\%BACKUP_FILE%
goto end

:cleanup
echo [WARNING] This will remove all monitoring data and containers.
set /p CONFIRM="Continue? (y/N): "
if /i not "%CONFIRM%"=="y" (
    echo [INFO] Cleanup cancelled
    goto end
)

echo [INFO] Cleaning up monitoring stack...
docker-compose -f docker-compose.monitoring.yml down -v
echo [SUCCESS] Monitoring stack cleaned up!
goto end

:test_alert
set ALERT_NAME=%2
set SEVERITY=%3
if "%ALERT_NAME%"=="" set ALERT_NAME=TestAlert
if "%SEVERITY%"=="" set SEVERITY=warning

echo [INFO] Sending test alert: %ALERT_NAME% (%SEVERITY%)

curl -X POST http://localhost:9093/api/v1/alerts ^
  -H "Content-Type: application/json" ^
  -d "[{\"labels\":{\"alertname\":\"%ALERT_NAME%\",\"severity\":\"%SEVERITY%\"},\"annotations\":{\"summary\":\"This is a test alert from monitoring-manage.bat\"}}]"

echo.
echo [SUCCESS] Test alert sent!
echo [INFO] Check AlertManager: http://localhost:9093
goto end

:health
echo [INFO] Checking monitoring stack health...

REM Check Prometheus
curl -s http://localhost:9090/-/healthy >nul 2>&1
if %errorlevel% equ 0 (
    echo [SUCCESS] Prometheus: Healthy
) else (
    echo [ERROR] Prometheus: Unhealthy
)

REM Check Grafana
curl -s http://localhost:3000/api/health >nul 2>&1
if %errorlevel% equ 0 (
    echo [SUCCESS] Grafana: Healthy
) else (
    echo [ERROR] Grafana: Unhealthy
)

REM Check Loki
curl -s http://localhost:3100/ready >nul 2>&1
if %errorlevel% equ 0 (
    echo [SUCCESS] Loki: Healthy
) else (
    echo [ERROR] Loki: Unhealthy
)

REM Check AlertManager
curl -s http://localhost:9093/-/healthy >nul 2>&1
if %errorlevel% equ 0 (
    echo [SUCCESS] AlertManager: Healthy
) else (
    echo [ERROR] AlertManager: Unhealthy
)
goto end

:help
echo AllnGrow Monitoring Management Script
echo.
echo Usage: %~nx0 [command] [options]
echo.
echo Commands:
echo   start                  Start monitoring stack
echo   stop                   Stop monitoring stack
echo   restart                Restart monitoring stack
echo   status                 Show monitoring stack status
echo   logs [service]         Show logs (optionally for specific service)
echo   update                 Update monitoring stack
echo   backup-grafana         Backup Grafana data
echo   cleanup                Remove all monitoring data and containers
echo   test-alert [name] [severity]  Send test alert
echo   health                 Check monitoring stack health
echo   help                   Show this help message
echo.
echo Examples:
echo   %~nx0 start
echo   %~nx0 logs grafana
echo   %~nx0 test-alert HighCPU critical
goto end

:end
endlocal

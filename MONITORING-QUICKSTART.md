# AllnGrow Monitoring - Quick Start Guide

Panduan cepat untuk setup dan menjalankan sistem monitoring AllnGrow.

## 🚀 Setup Cepat (5 Menit)

### Step 1: Persiapan

```bash
# Pastikan Docker dan Docker Compose sudah terinstall
docker --version
docker-compose --version

# Clone repository (jika belum)
cd AllnGrow-TestSIEM
```

### Step 2: Start Monitoring Stack

```bash
# Start semua monitoring services
docker-compose -f docker-compose.monitoring.yml up -d

# Tunggu beberapa detik untuk services ready
sleep 10

# Check status
docker-compose -f docker-compose.monitoring.yml ps
```

Expected output:
```
NAME                        STATUS    PORTS
allngrow-prometheus         Up        0.0.0.0:9090->9090/tcp
allngrow-grafana           Up        0.0.0.0:3000->3000/tcp
allngrow-loki              Up        0.0.0.0:3100->3100/tcp
allngrow-promtail          Up
allngrow-node-exporter     Up        0.0.0.0:9100->9100/tcp
allngrow-mysql-exporter    Up        0.0.0.0:9104->9104/tcp
allngrow-redis-exporter    Up        0.0.0.0:9121->9121/tcp
allngrow-nginx-exporter    Up        0.0.0.0:9113->9113/tcp
allngrow-cadvisor          Up        0.0.0.0:8080->8080/tcp
allngrow-alertmanager      Up        0.0.0.0:9093->9093/tcp
```

### Step 3: Start Aplikasi AllnGrow

```bash
# Start application services
docker-compose up -d

# Check status
docker-compose ps
```

### Step 4: Verify Monitoring

```bash
# Test Prometheus targets
curl http://localhost:9090/api/v1/targets | jq '.data.activeTargets[] | {job: .labels.job, health: .health}'

# Test Laravel metrics endpoint
curl http://localhost:8001/metrics

# Test Loki
curl http://localhost:3100/ready
```

### Step 5: Akses Grafana

1. Buka browser: http://localhost:3000
2. Login:
   - Username: `admin`
   - Password: `admin123`
3. Klik "Dashboards" → Browse
4. Pilih folder "AllnGrow"
5. Klik dashboard yang ingin dilihat

## 📊 Dashboard Overview

### 1. System Overview Dashboard
**URL**: http://localhost:3000/d/allngrow-system-overview

Menampilkan:
- CPU Usage gauge
- Memory Usage gauge
- Disk Usage gauge
- Services Status
- CPU Usage by Mode
- Memory Details
- Network Traffic
- Disk I/O

### 2. Laravel Application Dashboard
**URL**: http://localhost:3000/d/allngrow-laravel-app

Menampilkan:
- Request Rate
- Average Response Time
- 5xx Errors count
- Active Connections
- HTTP Requests by Status (2xx, 4xx, 5xx)
- Response Time Percentiles (p50, p95, p99)
- Database & Cache Connections
- Container Memory Usage

### 3. Database Monitoring Dashboard
**URL**: http://localhost:3000/d/allngrow-database

Menampilkan:
- MySQL Status (UP/DOWN)
- Connection Usage percentage
- Queries Per Second
- Slow Queries count
- Buffer Pool Size
- MySQL Connections graph
- Query Operations (SELECT, INSERT, UPDATE, DELETE)
- Cache Hit Rates
- Network Traffic
- Table Row Counts

### 4. Logs Monitoring Dashboard
**URL**: http://localhost:3000/d/allngrow-logs

Menampilkan:
- Log Volume by Level
- Laravel Error Logs
- Queue Worker Logs
- Nginx Error Responses (4xx, 5xx)
- HTTP Status Code Distribution (pie chart)
- HTTP Method Distribution (pie chart)
- Authentication Events
- Log Rate by Source

## 🧪 Testing Monitoring

### Generate Test Traffic

```bash
# Install Apache Bench (if not installed)
# Ubuntu/Debian: sudo apt-get install apache2-utils
# macOS: brew install ab
# Windows: download from Apache website

# Generate 1000 requests
ab -n 1000 -c 10 http://localhost:8001/

# Generate load for specific endpoints
ab -n 500 -c 5 http://localhost:8001/courses
ab -n 500 -c 5 http://localhost:8001/login
```

### Trigger Alerts (Testing)

```bash
# Generate CPU load
docker exec -it allngrow-app bash -c "yes > /dev/null &"

# Wait 5 minutes and check alerts
curl http://localhost:9090/api/v1/alerts | jq '.data.alerts[] | {alertname: .labels.alertname, state: .state}'

# Stop CPU load
docker exec -it allngrow-app pkill yes
```

### Check Logs

```bash
# View Laravel logs in real-time
docker exec -it allngrow-app tail -f storage/logs/laravel.log

# View queue worker logs
docker exec -it allngrow-app tail -f storage/logs/queue-worker.log

# View Nginx access logs
docker logs allngrow-app | grep nginx
```

## 📧 Setup Email Alerts (Optional)

### Gmail Configuration

1. Edit `monitoring/alertmanager/alertmanager.yml`:

```yaml
global:
  smtp_from: 'alerts@allngrow.com'
  smtp_smarthost: 'smtp.gmail.com:587'
  smtp_auth_username: 'your-email@gmail.com'
  smtp_auth_password: 'xxxx-xxxx-xxxx-xxxx'  # App Password
  smtp_require_tls: true
```

2. Dapatkan Gmail App Password:
   - https://myaccount.google.com/security
   - 2-Step Verification → App passwords
   - Generate new password
   - Copy password ke config

3. Update email recipients:

```yaml
receivers:
  - name: 'critical-receiver'
    email_configs:
      - to: 'your-email@gmail.com'
```

4. Restart AlertManager:

```bash
docker-compose -f docker-compose.monitoring.yml restart alertmanager
```

5. Test alert:

```bash
# Send test alert
curl -X POST http://localhost:9093/api/v1/alerts \
  -H "Content-Type: application/json" \
  -d '[
    {
      "labels": {
        "alertname": "TestAlert",
        "severity": "warning"
      },
      "annotations": {
        "summary": "This is a test alert"
      }
    }
  ]'
```

## 🔍 Common Queries

### Prometheus (PromQL)

```promql
# Top 5 CPU consuming processes
topk(5, rate(container_cpu_usage_seconds_total[5m]))

# Memory usage trend (last 1 hour)
node_memory_MemTotal_bytes - node_memory_MemAvailable_bytes

# HTTP error rate (4xx + 5xx)
rate(nginx_http_requests_total{status=~"4..|5.."}[5m])

# Database query rate
rate(mysql_global_status_queries[5m])

# Redis hit rate
rate(redis_keyspace_hits_total[5m]) / (rate(redis_keyspace_hits_total[5m]) + rate(redis_keyspace_misses_total[5m]))
```

### Loki (LogQL)

```logql
# Errors in last 1 hour
{job="laravel"} |= "error" [1h]

# Failed login attempts
{job="laravel"} |= "login" |= "failed"

# Slow database queries
{job="laravel"} |= "slow query"

# Top 10 error messages
topk(10, sum by (message) (count_over_time({job="laravel"} |= "error" [1h])))

# Request rate by status code
sum by (status) (rate({job="nginx-access"} [5m]))
```

## 🛠️ Troubleshooting

### Problem: Dashboard tidak menampilkan data

**Solution**:
```bash
# Check if Prometheus is collecting data
curl http://localhost:9090/api/v1/query?query=up

# Check Grafana datasource
# Go to: Configuration → Data Sources → Prometheus → Test

# Verify time range (data mungkin belum tersedia)
```

### Problem: Metrics endpoint error 404

**Solution**:
```bash
# Clear Laravel cache
docker exec -it allngrow-app php artisan cache:clear
docker exec -it allngrow-app php artisan config:clear
docker exec -it allngrow-app php artisan route:clear

# Restart application
docker-compose restart app
```

### Problem: Loki tidak menerima logs

**Solution**:
```bash
# Check Promtail logs
docker logs allngrow-promtail

# Check log file permissions
docker exec -it allngrow-app ls -la storage/logs/

# Fix permissions if needed
docker exec -it allngrow-app chmod -R 777 storage/logs/

# Restart Promtail
docker-compose -f docker-compose.monitoring.yml restart promtail
```

### Problem: Alert tidak terkirim

**Solution**:
```bash
# Check AlertManager config
docker exec -it allngrow-alertmanager amtool check-config /etc/alertmanager/alertmanager.yml

# View AlertManager logs
docker logs allngrow-alertmanager

# Test email config
docker exec -it allngrow-alertmanager amtool config routes test
```

## 📈 Performance Tuning

### Adjust Scrape Intervals

Edit `monitoring/prometheus/prometheus.yml`:

```yaml
global:
  scrape_interval: 30s      # Increase for less load (default: 15s)
  evaluation_interval: 30s
```

### Adjust Log Retention

Edit `monitoring/loki/loki-config.yml`:

```yaml
limits_config:
  retention_period: 168h  # 7 days instead of 31 days
```

### Reduce Dashboard Refresh Rate

In Grafana dashboard settings:
- Click gear icon (⚙️) → Settings
- Change "Refresh" from 30s to 1m or 5m

## 🎯 Next Steps

1. **Customize Alerts**
   - Review alert thresholds di `monitoring/prometheus/alerts/allngrow-alerts.yml`
   - Adjust berdasarkan baseline aplikasi

2. **Add Custom Metrics**
   - Tambah metrics di `app/Http/Controllers/MetricsController.php`
   - Update dashboard untuk visualize metrics baru

3. **Create Runbooks**
   - Document procedures untuk handle common alerts
   - Share dengan team

4. **Setup Backup**
   - Backup Grafana dashboards
   - Backup Prometheus data
   - Automate backup process

5. **Security Hardening**
   - Change default passwords
   - Setup HTTPS
   - Restrict network access

## 📞 Quick Reference

| Service | URL | Username | Password |
|---------|-----|----------|----------|
| Grafana | http://localhost:3000 | admin | admin123 |
| Prometheus | http://localhost:9090 | - | - |
| AlertManager | http://localhost:9093 | - | - |
| cAdvisor | http://localhost:8080 | - | - |
| Application | http://localhost:8001 | - | - |

## 🔗 Useful Links

- Full Documentation: [MONITORING.md](./MONITORING.md)
- Prometheus Queries: http://localhost:9090/graph
- Loki Queries: http://localhost:3000/explore (select Loki datasource)
- Alert Rules: http://localhost:9090/rules
- Active Alerts: http://localhost:9090/alerts

---

**Happy Monitoring! 🎉**

Jika ada pertanyaan, check full documentation di [MONITORING.md](./MONITORING.md)

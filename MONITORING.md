# AllnGrow Monitoring System

Sistem monitoring lengkap untuk aplikasi AllnGrow menggunakan Grafana, Prometheus, Loki, dan tools monitoring lainnya.

## 📊 Arsitektur Monitoring

Sistem monitoring AllnGrow terdiri dari komponen-komponen berikut:

### 1. **Grafana** (Port 3000)
- Dashboard visualisasi utama
- Username: `admin`
- Password: `admin123`
- Dashboard yang tersedia:
  - System Overview: Monitoring CPU, Memory, Disk, Network
  - Laravel Application: Metrics aplikasi Laravel
  - Database Monitoring: MySQL metrics
  - Logs Monitoring: Agregasi dan visualisasi logs

### 2. **Prometheus** (Port 9090)
- Time-series database untuk metrics
- Mengumpulkan metrics dari berbagai exporters
- Alert manager terintegrasi

### 3. **Loki** (Port 3100)
- Log aggregation system
- Menyimpan logs dari Laravel, Nginx, dan sistem

### 4. **Promtail**
- Log shipper yang mengirim logs ke Loki
- Mengumpulkan logs dari:
  - Laravel application logs
  - Laravel queue worker logs
  - Nginx access logs
  - Nginx error logs

### 5. **Exporters**
- **Node Exporter** (Port 9100): System metrics
- **MySQL Exporter** (Port 9104): Database metrics
- **Redis Exporter** (Port 9121): Cache/Queue metrics
- **Nginx Exporter** (Port 9113): Web server metrics
- **cAdvisor** (Port 8080): Container metrics

### 6. **AlertManager** (Port 9093)
- Mengelola alerts dari Prometheus
- Mengirim notifikasi via email/webhook

## 🚀 Cara Menjalankan

### 1. Jalankan Monitoring Stack

```bash
# Start monitoring services
docker-compose -f docker-compose.monitoring.yml up -d

# Check status
docker-compose -f docker-compose.monitoring.yml ps
```

### 2. Jalankan Aplikasi AllnGrow

```bash
# Start application services
docker-compose up -d

# Verify all services are running
docker ps
```

### 3. Akses Dashboard

- **Grafana**: http://localhost:3000
  - Login: admin / admin123
  - Dashboards sudah otomatis ter-provision

- **Prometheus**: http://localhost:9090
  - Lihat targets: http://localhost:9090/targets
  - Lihat alerts: http://localhost:9090/alerts

- **AlertManager**: http://localhost:9093
  - Lihat active alerts

- **cAdvisor**: http://localhost:8080
  - Real-time container metrics

## 📈 Metrics yang Dikumpulkan

### System Metrics
- CPU usage by core and mode
- Memory usage (total, available, used)
- Disk usage and I/O operations
- Network traffic (receive/transmit)
- Load average

### Application Metrics (Laravel)
- HTTP request rate and duration
- Request status codes (2xx, 4xx, 5xx)
- Response time percentiles (p50, p95, p99)
- Slow requests (> 1 second)
- Active database connections
- Queue job metrics
- User counts (students, instructors, admins)
- Course metrics
- Lesson completion rates

### Database Metrics (MySQL)
- Connection usage
- Queries per second
- Slow queries count
- Buffer pool hit rate
- Query cache hit rate
- Table row counts
- Network traffic

### Cache Metrics (Redis)
- Connection status
- Memory usage
- Connected clients
- Keys count
- Hit/miss rates

### Web Server Metrics (Nginx)
- Request rate
- Response codes
- Active connections
- Request duration

### Container Metrics
- CPU usage per container
- Memory usage per container
- Network I/O per container
- Disk I/O per container

## 🔍 Log Monitoring

### Log Sources
1. **Laravel Application Logs** (`storage/logs/*.log`)
   - Application events
   - Error logs
   - Authentication events
   - Database queries (debug mode)

2. **Queue Worker Logs** (`storage/logs/queue-worker.log`)
   - Job processing
   - Failed jobs
   - Queue status

3. **Nginx Access Logs**
   - HTTP requests
   - Response codes
   - Request methods

4. **Nginx Error Logs**
   - Server errors
   - Configuration issues

### Log Queries di Grafana

Contoh LogQL queries:

```logql
# Error logs dari Laravel
{job="laravel"} |= "error" or "ERROR"

# Failed queue jobs
{job="laravel-queue"} |= "failed"

# 4xx dan 5xx responses
{job="nginx-access"} | json | status >= 400

# Authentication events
{job="laravel"} |= "login" or "logout" or "authentication"

# Slow requests (lebih dari 2 detik)
{job="nginx-access"} | json | request_time > 2
```

## 🚨 Alerts yang Dikonfigurasi

### Critical Alerts (Notifikasi Immediate)
- **InstanceDown**: Service tidak responding (> 2 menit)
- **MySQLDown**: Database tidak tersedia
- **RedisDown**: Cache tidak tersedia
- **ContainerDown**: Container AllnGrow mati

### Warning Alerts (Notifikasi Batched)
- **HighCPUUsage**: CPU > 80% (5 menit)
- **HighMemoryUsage**: Memory > 85% (5 menit)
- **DiskSpaceLow**: Disk space < 15%
- **HighMySQLConnections**: MySQL connections > 80%
- **HighRedisMemoryUsage**: Redis memory > 85%
- **HighContainerCPUUsage**: Container CPU > 80%
- **HighContainerMemoryUsage**: Container memory > 85%
- **NginxHighResponseTime**: Response time > 2 detik
- **LaravelQueueJobsFailing**: Queue jobs gagal

## 📧 Konfigurasi Email Alerts

Edit file `monitoring/alertmanager/alertmanager.yml`:

```yaml
global:
  smtp_from: 'alertmanager@allngrow.com'
  smtp_smarthost: 'smtp.gmail.com:587'
  smtp_auth_username: 'your-email@gmail.com'
  smtp_auth_password: 'your-app-password'
  smtp_require_tls: true
```

Untuk Gmail, gunakan App Password:
1. Buka Google Account Settings
2. Security → 2-Step Verification
3. App passwords → Generate new app password
4. Copy password ke konfigurasi

## 🔧 Konfigurasi Webhook (Slack/Discord/Teams)

### Slack Integration

Edit `monitoring/alertmanager/alertmanager.yml`:

```yaml
receivers:
  - name: 'critical-receiver'
    webhook_configs:
      - url: 'https://hooks.slack.com/services/YOUR/SLACK/WEBHOOK'
        send_resolved: true
```

### Discord Integration

```yaml
receivers:
  - name: 'critical-receiver'
    webhook_configs:
      - url: 'https://discord.com/api/webhooks/YOUR/WEBHOOK'
        send_resolved: true
```

## 📊 Custom Dashboards

### Membuat Dashboard Baru

1. Login ke Grafana (http://localhost:3000)
2. Klik "+" → "Create Dashboard"
3. Add Panel
4. Pilih Data Source (Prometheus atau Loki)
5. Tulis query
6. Customize visualization
7. Save dashboard

### Import Dashboard dari Grafana.com

1. Browse dashboards di https://grafana.com/grafana/dashboards/
2. Copy dashboard ID
3. Di Grafana: "+" → "Import"
4. Paste dashboard ID
5. Select Prometheus datasource
6. Import

Dashboard yang direkomendasikan:
- Node Exporter Full: 1860
- MySQL Overview: 7362
- Redis Dashboard: 763
- Docker Container & Host Metrics: 179
- Nginx Overview: 12708

## 🔍 Query Examples

### Prometheus Queries (PromQL)

```promql
# CPU Usage
100 - (avg by(instance) (irate(node_cpu_seconds_total{mode="idle"}[5m])) * 100)

# Memory Usage
(1 - (node_memory_MemAvailable_bytes / node_memory_MemTotal_bytes)) * 100

# Request Rate
rate(nginx_http_requests_total[5m])

# Error Rate
rate(nginx_http_requests_total{status=~"5.."}[5m])

# MySQL Queries per Second
rate(mysql_global_status_queries[5m])

# Redis Memory Usage
redis_memory_used_bytes / redis_memory_max_bytes * 100
```

### Loki Queries (LogQL)

```logql
# All Laravel errors
{job="laravel"} |= "error"

# Authentication failures
{job="laravel"} |= "authentication" |= "failed"

# Slow queries
{job="laravel"} |= "slow query"

# 500 errors from Nginx
{job="nginx-access"} | json | status = 500

# Top 10 most requested URLs
topk(10, sum by (request) (count_over_time({job="nginx-access"} [1h])))
```

## 🛠️ Troubleshooting

### Prometheus tidak bisa scrape metrics

```bash
# Check Prometheus targets
curl http://localhost:9090/api/v1/targets

# Check Laravel metrics endpoint
curl http://localhost:8001/metrics

# Restart Prometheus
docker-compose -f docker-compose.monitoring.yml restart prometheus
```

### Loki tidak menerima logs

```bash
# Check Promtail status
docker logs allngrow-promtail

# Check Loki status
curl http://localhost:3100/ready

# Verify log files exist
ls -la storage/logs/

# Restart Promtail
docker-compose -f docker-compose.monitoring.yml restart promtail
```

### Grafana dashboard tidak menampilkan data

1. Check datasource connection:
   - Configuration → Data Sources
   - Test each datasource
   - Verify URLs are correct

2. Check time range:
   - Pastikan time range di dashboard sesuai
   - Data mungkin belum ter-collect

3. Check queries:
   - Buka Query Inspector
   - Lihat error messages
   - Adjust queries jika perlu

### Alerts tidak terkirim

```bash
# Check AlertManager logs
docker logs allngrow-alertmanager

# Test email configuration
docker exec -it allngrow-alertmanager amtool check-config /etc/alertmanager/alertmanager.yml

# Check alert rules
curl http://localhost:9090/api/v1/rules
```

## 📦 Maintenance

### Backup Grafana Dashboards

```bash
# Export all dashboards
docker exec -it allngrow-grafana grafana-cli admin export-dashboard

# Backup Grafana database
docker exec -it allngrow-grafana tar czf /tmp/grafana-backup.tar.gz /var/lib/grafana
docker cp allngrow-grafana:/tmp/grafana-backup.tar.gz ./backup/
```

### Cleanup Old Data

```bash
# Prometheus (otomatis cleanup setelah 30 hari)
# Konfigurasi di prometheus.yml: --storage.tsdb.retention.time=30d

# Loki (otomatis cleanup setelah 31 hari)
# Konfigurasi di loki-config.yml: retention_period: 744h

# Manual cleanup container logs
docker system prune -a --volumes
```

### Update Monitoring Stack

```bash
# Pull latest images
docker-compose -f docker-compose.monitoring.yml pull

# Restart services
docker-compose -f docker-compose.monitoring.yml down
docker-compose -f docker-compose.monitoring.yml up -d
```

## 🔐 Security Best Practices

1. **Ubah Default Passwords**
   - Grafana admin password
   - MySQL root password
   - Redis password (jika ada)

2. **Restrict Access**
   - Gunakan firewall untuk limit akses ke monitoring ports
   - Hanya allow dari IP terpercaya
   - Gunakan VPN jika akses dari public network

3. **Enable HTTPS**
   - Setup reverse proxy (Nginx/Traefik)
   - Install SSL certificates (Let's Encrypt)
   - Redirect HTTP to HTTPS

4. **Regular Updates**
   - Update monitoring stack secara berkala
   - Monitor security advisories
   - Apply security patches

## 📚 Resources

- [Prometheus Documentation](https://prometheus.io/docs/)
- [Grafana Documentation](https://grafana.com/docs/)
- [Loki Documentation](https://grafana.com/docs/loki/)
- [Node Exporter](https://github.com/prometheus/node_exporter)
- [MySQL Exporter](https://github.com/prometheus/mysqld_exporter)
- [Redis Exporter](https://github.com/oliver006/redis_exporter)

## 💡 Tips & Tricks

1. **Gunakan Variables di Dashboard**
   - Buat template variables untuk filter data
   - Contoh: environment, server, application

2. **Setup Annotations**
   - Mark deployment events
   - Track incidents
   - Correlate changes with metrics

3. **Create Alert Rules Gradually**
   - Mulai dengan critical alerts
   - Monitor false positives
   - Adjust thresholds sesuai baseline

4. **Regular Review**
   - Review dashboards mingguan
   - Identify trends
   - Optimize resources

5. **Documentation**
   - Document runbooks untuk common alerts
   - Create incident response procedures
   - Share knowledge dengan tim

## 🆘 Support

Jika ada pertanyaan atau masalah:
1. Check logs: `docker-compose -f docker-compose.monitoring.yml logs`
2. Review documentation
3. Check GitHub issues
4. Contact support team

---

**Version**: 1.0.0
**Last Updated**: 2024
**Maintained by**: AllnGrow DevOps Team

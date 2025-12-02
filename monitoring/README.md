# Monitoring Configuration Directory

This directory contains all configuration files for the AllnGrow monitoring stack.

## 📁 Directory Structure

```
monitoring/
├── prometheus/
│   ├── prometheus.yml          # Prometheus main configuration
│   └── alerts/
│       └── allngrow-alerts.yml # Alert rules
├── grafana/
│   ├── provisioning/
│   │   ├── datasources/
│   │   │   └── datasources.yml # Grafana datasources
│   │   └── dashboards/
│   │       └── dashboards.yml  # Dashboard provisioning
│   └── dashboards/
│       ├── system-overview.json
│       ├── laravel-application.json
│       ├── database-monitoring.json
│       └── logs-monitoring.json
├── loki/
│   └── loki-config.yml         # Loki configuration
├── promtail/
│   └── promtail-config.yml     # Promtail configuration
└── alertmanager/
    └── alertmanager.yml        # AlertManager configuration
```

## 🔧 Configuration Files

### Prometheus Configuration

**File**: `prometheus/prometheus.yml`

Main Prometheus configuration containing:
- Global settings (scrape interval, evaluation interval)
- Alertmanager integration
- Scrape configurations for all exporters
- Job definitions

**Jobs configured**:
- prometheus (self-monitoring)
- node-exporter (system metrics)
- mysql-exporter (database metrics)
- redis-exporter (cache/queue metrics)
- nginx-exporter (web server metrics)
- cadvisor (container metrics)
- laravel-app (application metrics)

### Alert Rules

**File**: `prometheus/alerts/allngrow-alerts.yml`

Contains alert rules grouped by:
- System alerts (CPU, Memory, Disk)
- Database alerts (MySQL connection, slow queries)
- Cache alerts (Redis status, memory)
- Container alerts (container status, resources)
- Application alerts (response time, queue jobs)

**Severity levels**:
- `critical`: Immediate attention required
- `warning`: Should be addressed soon

### Grafana Datasources

**File**: `grafana/provisioning/datasources/datasources.yml`

Automatically provisions datasources:
- Prometheus (default)
- Loki (logs)
- MySQL (direct queries)

### Grafana Dashboards

**Directory**: `grafana/dashboards/`

Pre-built dashboards:
1. **system-overview.json**: System resource monitoring
2. **laravel-application.json**: Laravel application metrics
3. **database-monitoring.json**: MySQL database metrics
4. **logs-monitoring.json**: Log aggregation and visualization

### Loki Configuration

**File**: `loki/loki-config.yml`

Loki settings:
- Storage configuration (filesystem)
- Retention policy (31 days)
- Query limits
- Compaction settings

### Promtail Configuration

**File**: `promtail/promtail-config.yml`

Log collection configuration:
- Log sources (Laravel, Nginx, system)
- Label extraction
- Pipeline stages
- Log parsing rules

### AlertManager Configuration

**File**: `alertmanager/alertmanager.yml`

Alert routing and notification:
- SMTP configuration for email alerts
- Receiver groups
- Routing rules by severity
- Inhibition rules

## 🎨 Customization

### Adding New Metrics

1. Add scrape config to `prometheus/prometheus.yml`:

```yaml
scrape_configs:
  - job_name: 'my-new-service'
    static_configs:
      - targets: ['service:port']
        labels:
          service: 'my-service'
```

2. Restart Prometheus:

```bash
docker-compose -f docker-compose.monitoring.yml restart prometheus
```

### Adding New Alert Rules

1. Edit `prometheus/alerts/allngrow-alerts.yml`:

```yaml
- alert: MyNewAlert
  expr: my_metric > 100
  for: 5m
  labels:
    severity: warning
  annotations:
    summary: "My alert summary"
    description: "My alert description"
```

2. Reload Prometheus config:

```bash
curl -X POST http://localhost:9090/-/reload
```

### Adding New Dashboard

1. Create dashboard in Grafana UI
2. Export dashboard JSON
3. Save to `grafana/dashboards/my-dashboard.json`
4. Dashboard will be auto-loaded on restart

### Customizing Email Alerts

Edit `alertmanager/alertmanager.yml`:

```yaml
global:
  smtp_from: 'alerts@example.com'
  smtp_smarthost: 'smtp.example.com:587'
  smtp_auth_username: 'user@example.com'
  smtp_auth_password: 'password'

receivers:
  - name: 'team-email'
    email_configs:
      - to: 'team@example.com'
```

## 🔄 Reload Configuration

### Prometheus

```bash
# Hot reload (without restart)
curl -X POST http://localhost:9090/-/reload

# Or restart
docker-compose -f docker-compose.monitoring.yml restart prometheus
```

### Grafana

```bash
# Restart required for most changes
docker-compose -f docker-compose.monitoring.yml restart grafana

# Datasources and dashboards are auto-reloaded
```

### Loki

```bash
# Restart required
docker-compose -f docker-compose.monitoring.yml restart loki
```

### Promtail

```bash
# Restart required
docker-compose -f docker-compose.monitoring.yml restart promtail
```

### AlertManager

```bash
# Hot reload
curl -X POST http://localhost:9093/-/reload

# Or restart
docker-compose -f docker-compose.monitoring.yml restart alertmanager
```

## 🐛 Troubleshooting

### Check Configuration Syntax

```bash
# Prometheus
docker exec allngrow-prometheus promtool check config /etc/prometheus/prometheus.yml

# AlertManager
docker exec allngrow-alertmanager amtool check-config /etc/alertmanager/alertmanager.yml
```

### View Logs

```bash
# Prometheus logs
docker logs allngrow-prometheus

# Grafana logs
docker logs allngrow-grafana

# Loki logs
docker logs allngrow-loki

# Promtail logs
docker logs allngrow-promtail
```

### Reset Configuration

```bash
# Stop services
docker-compose -f docker-compose.monitoring.yml down

# Remove volumes (WARNING: This deletes all data)
docker volume rm allngrow_prometheus-data allngrow_grafana-data allngrow_loki-data

# Restart
docker-compose -f docker-compose.monitoring.yml up -d
```

## 📝 Best Practices

1. **Version Control**: Keep all configuration files in git
2. **Backup**: Regularly backup Grafana dashboards
3. **Testing**: Test alert rules before production deployment
4. **Documentation**: Document custom metrics and dashboards
5. **Security**: Use strong passwords and restrict network access

## 🔗 Resources

- [Prometheus Documentation](https://prometheus.io/docs/)
- [Grafana Documentation](https://grafana.com/docs/)
- [Loki Documentation](https://grafana.com/docs/loki/)
- [AlertManager Documentation](https://prometheus.io/docs/alerting/latest/alertmanager/)

---

For complete monitoring documentation, see [../MONITORING.md](../MONITORING.md)

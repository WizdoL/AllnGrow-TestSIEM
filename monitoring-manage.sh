#!/bin/bash

# AllnGrow Monitoring Management Script
# This script helps manage the monitoring stack

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Print colored output
print_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if Docker is running
check_docker() {
    if ! docker info > /dev/null 2>&1; then
        print_error "Docker is not running. Please start Docker first."
        exit 1
    fi
    print_success "Docker is running"
}

# Check if Docker Compose is installed
check_docker_compose() {
    if ! command -v docker-compose &> /dev/null; then
        print_error "docker-compose is not installed. Please install it first."
        exit 1
    fi
    print_success "docker-compose is installed"
}

# Start monitoring stack
start_monitoring() {
    print_info "Starting monitoring stack..."
    docker-compose -f docker-compose.monitoring.yml up -d

    print_info "Waiting for services to be ready..."
    sleep 10

    print_success "Monitoring stack started!"
    print_info "Access URLs:"
    echo "  - Grafana: http://localhost:3000 (admin/admin123)"
    echo "  - Prometheus: http://localhost:9090"
    echo "  - AlertManager: http://localhost:9093"
    echo "  - cAdvisor: http://localhost:8080"
}

# Stop monitoring stack
stop_monitoring() {
    print_info "Stopping monitoring stack..."
    docker-compose -f docker-compose.monitoring.yml down
    print_success "Monitoring stack stopped!"
}

# Restart monitoring stack
restart_monitoring() {
    print_info "Restarting monitoring stack..."
    docker-compose -f docker-compose.monitoring.yml restart
    print_success "Monitoring stack restarted!"
}

# Show monitoring stack status
status_monitoring() {
    print_info "Monitoring stack status:"
    docker-compose -f docker-compose.monitoring.yml ps
}

# Show monitoring logs
logs_monitoring() {
    SERVICE=${1:-}
    if [ -z "$SERVICE" ]; then
        print_info "Showing all monitoring logs (Ctrl+C to exit)..."
        docker-compose -f docker-compose.monitoring.yml logs -f
    else
        print_info "Showing logs for $SERVICE (Ctrl+C to exit)..."
        docker-compose -f docker-compose.monitoring.yml logs -f "$SERVICE"
    fi
}

# Update monitoring stack
update_monitoring() {
    print_info "Updating monitoring stack..."
    docker-compose -f docker-compose.monitoring.yml pull
    docker-compose -f docker-compose.monitoring.yml up -d
    print_success "Monitoring stack updated!"
}

# Backup Grafana data
backup_grafana() {
    BACKUP_DIR="./backups/grafana"
    BACKUP_FILE="grafana-backup-$(date +%Y%m%d-%H%M%S).tar.gz"

    print_info "Creating backup directory..."
    mkdir -p "$BACKUP_DIR"

    print_info "Backing up Grafana data..."
    docker exec allngrow-grafana tar czf /tmp/grafana-backup.tar.gz /var/lib/grafana
    docker cp allngrow-grafana:/tmp/grafana-backup.tar.gz "$BACKUP_DIR/$BACKUP_FILE"
    docker exec allngrow-grafana rm /tmp/grafana-backup.tar.gz

    print_success "Grafana backup created: $BACKUP_DIR/$BACKUP_FILE"
}

# Restore Grafana data
restore_grafana() {
    BACKUP_FILE=${1:-}

    if [ -z "$BACKUP_FILE" ]; then
        print_error "Please specify backup file path"
        echo "Usage: $0 restore-grafana <backup-file>"
        exit 1
    fi

    if [ ! -f "$BACKUP_FILE" ]; then
        print_error "Backup file not found: $BACKUP_FILE"
        exit 1
    fi

    print_warning "This will overwrite existing Grafana data. Continue? (y/N)"
    read -r response
    if [[ ! "$response" =~ ^[Yy]$ ]]; then
        print_info "Restore cancelled"
        exit 0
    fi

    print_info "Stopping Grafana..."
    docker-compose -f docker-compose.monitoring.yml stop grafana

    print_info "Restoring Grafana data..."
    docker cp "$BACKUP_FILE" allngrow-grafana:/tmp/grafana-backup.tar.gz
    docker exec allngrow-grafana tar xzf /tmp/grafana-backup.tar.gz -C /
    docker exec allngrow-grafana rm /tmp/grafana-backup.tar.gz

    print_info "Starting Grafana..."
    docker-compose -f docker-compose.monitoring.yml start grafana

    print_success "Grafana data restored!"
}

# Clean old data
cleanup_monitoring() {
    print_warning "This will remove all monitoring data and containers. Continue? (y/N)"
    read -r response
    if [[ ! "$response" =~ ^[Yy]$ ]]; then
        print_info "Cleanup cancelled"
        exit 0
    fi

    print_info "Cleaning up monitoring stack..."
    docker-compose -f docker-compose.monitoring.yml down -v
    print_success "Monitoring stack cleaned up!"
}

# Test alerts
test_alert() {
    ALERT_NAME=${1:-TestAlert}
    SEVERITY=${2:-warning}

    print_info "Sending test alert: $ALERT_NAME ($SEVERITY)"

    curl -X POST http://localhost:9093/api/v1/alerts \
      -H "Content-Type: application/json" \
      -d "[
        {
          \"labels\": {
            \"alertname\": \"$ALERT_NAME\",
            \"severity\": \"$SEVERITY\"
          },
          \"annotations\": {
            \"summary\": \"This is a test alert from monitoring-manage.sh\"
          }
        }
      ]"

    print_success "Test alert sent!"
    print_info "Check AlertManager: http://localhost:9093"
}

# Check monitoring health
health_check() {
    print_info "Checking monitoring stack health..."

    # Check Prometheus
    if curl -s http://localhost:9090/-/healthy > /dev/null 2>&1; then
        print_success "Prometheus: Healthy"
    else
        print_error "Prometheus: Unhealthy"
    fi

    # Check Grafana
    if curl -s http://localhost:3000/api/health > /dev/null 2>&1; then
        print_success "Grafana: Healthy"
    else
        print_error "Grafana: Unhealthy"
    fi

    # Check Loki
    if curl -s http://localhost:3100/ready > /dev/null 2>&1; then
        print_success "Loki: Healthy"
    else
        print_error "Loki: Unhealthy"
    fi

    # Check AlertManager
    if curl -s http://localhost:9093/-/healthy > /dev/null 2>&1; then
        print_success "AlertManager: Healthy"
    else
        print_error "AlertManager: Unhealthy"
    fi
}

# Show help
show_help() {
    echo "AllnGrow Monitoring Management Script"
    echo ""
    echo "Usage: $0 [command] [options]"
    echo ""
    echo "Commands:"
    echo "  start                  Start monitoring stack"
    echo "  stop                   Stop monitoring stack"
    echo "  restart                Restart monitoring stack"
    echo "  status                 Show monitoring stack status"
    echo "  logs [service]         Show logs (optionally for specific service)"
    echo "  update                 Update monitoring stack"
    echo "  backup-grafana         Backup Grafana data"
    echo "  restore-grafana FILE   Restore Grafana data from backup"
    echo "  cleanup                Remove all monitoring data and containers"
    echo "  test-alert [name] [severity]  Send test alert"
    echo "  health                 Check monitoring stack health"
    echo "  help                   Show this help message"
    echo ""
    echo "Examples:"
    echo "  $0 start"
    echo "  $0 logs grafana"
    echo "  $0 test-alert HighCPU critical"
    echo "  $0 restore-grafana ./backups/grafana/grafana-backup-20240101-120000.tar.gz"
}

# Main script
main() {
    # Check prerequisites
    check_docker
    check_docker_compose

    # Parse command
    COMMAND=${1:-help}

    case $COMMAND in
        start)
            start_monitoring
            ;;
        stop)
            stop_monitoring
            ;;
        restart)
            restart_monitoring
            ;;
        status)
            status_monitoring
            ;;
        logs)
            logs_monitoring "$2"
            ;;
        update)
            update_monitoring
            ;;
        backup-grafana)
            backup_grafana
            ;;
        restore-grafana)
            restore_grafana "$2"
            ;;
        cleanup)
            cleanup_monitoring
            ;;
        test-alert)
            test_alert "$2" "$3"
            ;;
        health)
            health_check
            ;;
        help|--help|-h)
            show_help
            ;;
        *)
            print_error "Unknown command: $COMMAND"
            echo ""
            show_help
            exit 1
            ;;
    esac
}

# Run main function
main "$@"

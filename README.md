# Alibaba cloud Application Load Balancer Demo

## Step to follow

1. Spin up 1 RDS instance and note the access IP address.
2. Spin up 1 ECS.
3. Install LEMP stack on it.
4. Edit index.php, add RDS access IP address in `$host` variable.
5. Put index.php in `/var/www/html` 
6. Put todo.conf in `/etc/nginx/conf.d/todo.conf
7. Restart nginx with: `systemctl restart nginx`
8. Take a snapshot.
9. Spin up 2 More ECS from that snapshot.
10. Set up ALB by following Alibaba cloud console suggestions.
11. Enjoy!

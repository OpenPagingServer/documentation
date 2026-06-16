# Reverse proxies

Reverse proxies are commonly when deploying your web apps to WAN for security or when sharing one public IP for multiple hosts. 

For security, Open Paging Server only trusts reverse proxies on localhost by default. If you are using an external reverse proxy, you will need to manually trust them.

It's highly recommended to use reverse proxies if you are exposing Open Paging Server's web interface and/or API to the internet.

## Trusting reverse proxies
???+ warning "Ensure all trusted reverse proxies use a static IP for security"
     It's highly discouraged to use a reverse proxy with DHCP. Not only could this cause issues if you are using port fowarding and with DNS, but if another device gets assigned that IP address, they will be treated as a trusted reverse proxy.
	 
The list of trusted reverse proxies is located in .env in Open Paging Server's top directory. 

```
WEB_REVERSE_PROXY_ALLOWED=127.0.0.1 # Allowed reverse proxies for the web interface
API_REVERSE_PROXY_ALLOWED=127.0.0.1    # Allowed reverse proxies for the API
```

You can add IPs or subnets. An IPv4 without a CIDR notation will be treated as a /32. Most of the time, theres no reason to trust entire subnet unless you are directly using a cloud or public reverse proxy such as Cloudflare or CloudFront. 

Add more than one IP or subnet by using commas. For example:

```
WEB_REVERSE_PROXY_ALLOWED=127.0.0.1,10.0.0.5
API_REVERSE_PROXY_ALLOWED=127.0.0.1,10.0.0.6
```

You will need to restart Open Paging Server for chanegs to take affect.


## Local hosted reverse proxies
Local hosted reverse proxies (such as NGINX, Apache2, and HAProxy) can either be used on the local system or on a remote server. If running the reverse proxy on the local system, set the web and/or API interface to listen on localhost (127.0.0.1) only. It's highly recommended to use a high port other than the common HTTP(S) ports of 80, 443, 8080, and 8443.

When running the reverse proxy on a remote server, it can be used to serve both Open Paging Server and other websites or applications on your network from one IP address using hostnames. Running the reverse proxy either local or remote can also bring security improvements, load balancing, and allow more than one application to run on the same server alongisde Open Paging Server using the same port.

### Example NGINX Config (HTTP Only)
```
server {
    listen 80;
    server_name _; # This will match any hostname. Change this to your hostname if necessary.

    location / {
        proxy_pass http://127.0.0.1:80/; # Adjust this if necessary
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
		proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $host;
        proxy_read_timeout 3600s;
        proxy_send_timeout 3600s;
        proxy_buffering off;
    }
}
```

## Cloud services (Cloudflare, CloudFront, etc)
You will either need to open your Open Paging Server directly to the internet, or via a local reverse proxy. If you running a local reverse proxy in path, you will only need to trust that reverse proxy.

When reverse proxying with Cloudflare directly:

- You will need to trust their IP ranges. [You can find their full list here](https://www.cloudflare.com/ips/). 

- [You must use a supported port, and Open Paging Server must be listening on the port you are using to access it from the public internet.](https://developers.cloudflare.com/fundamentals/reference/network-ports/)

- You should not reveal your public IP address to anyone, as doing so will break the protections of Cloudflare. Using a local reverse proxy, especially on a remote server on your network (such as the firewall) can provide some protection if this happens.


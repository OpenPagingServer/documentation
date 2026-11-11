# Debug mode

This page contains tutorials for how to enable debug mode on all Open Paging Server software and firmware products.
## Open Paging Server

To enable debug mode in Open Paging Server, set `DEBUG=true` in .env and restart openpagingserver. 

When enabled, debug logs will be written in /var/log/openpagingserver and /opt/OpenPagingServer in old verisons.

Python tracebacks will also become viewable from the web interface upon an crash.

## client-browser

On the browser extension, open the settings page and type `debug` on your keyboard. A new option will appear titled `SQUASH SOME BUGS!!!!!`. Enable this. Then click about and click debug to view real-time logs.

On managed browsers, debug may be disabled by the system administrator.
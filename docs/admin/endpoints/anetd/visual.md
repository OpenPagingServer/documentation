## Configure text scroll for visual messages on Advanced Network Devices

For models with clocks or displays, you can also use HTTP requests to display visual messages. Each device must be manually configured.

The device should either have a static IP address via your DHCP server or set on the device, or use it's DNS hostname (e.g. `http://ipspeaker[MACADDRESS].local`).

First, set the `General Command Password` under `Network`. It's recommended to use a different one per device. You can also change the `HTTP Command Port` as well per clock. Make sure you write down the new port for each device with it's MAC address somewhere safe, since the web interface will also run on this port. 

In Open Paging Server, create a new HTTP request endpoint. Use either GET or POST with the following URL:

`http://<HOST>/broadcast?display&password=YOURPASSWORD&shortText=${shortmessage}&scrollSpeed=7&repetitions=30&color=${color}&prio=1`

Replace `<HOST>` with your clocks IP address or hostname. Replace `YOURPASSWORD` with your `General Command Password`. You can adjust `scrollSpeed` and `repetitions` as desired. And you can set `prio` based on a priority under `Priorities` in the clock's settings interface. This is where you can control the flashers. 

Once added, add the HTTP request endpoint to the same group(s) as the multicast RTP endpoint.
# Connect Advanced Network Devices IP Speakers to Open Paging Server

Using a multicast RTP stream, you can use Advanced Network Devices IP Speakers on Open Paging Server. For models with clocks, you can also use HTTP requests to display visual messages. Each device must be manually configured. In the end, you'll have 2 endpoints that can be added to a group. One for visual, and one for audio.

## Add a Multicast RTP Stream

You can either create a new stream or use an existing one. Only streams of PCMU (μ-law) is supported on most Advanced Network Devices endpoints. Each stream act's as a "zone". You can add multiple speakers on a single stream, use multiple streams on one speaker, etc. It's recommended to zone out your speakers based on logical methods. Such as per building/facility, per floor, per area, etc. You could use one speaker per stream, however this is not recommended for large setups. You can use the built-in SIP functionality if you need per-room calling.

To create a new Multicast RTP stream in Open Paging Server, go to `Manage Endpoints` > `+` > `Multicast RTP`. 

Enter a name, choose an unused Multicast Address and Even Port. 

Ensure `PCMU` is selected as the codec.

Click `Add Multicast RTP`.

## Configure the speaker to listen

Go to the speaker's web interface using it's IP address in your web browser. The IP address is shown on clocks on first boot.

Go to `Device Settings` > `Streams` and add the new stream in `IP:Port` in `Permanent Streams`. It's recommended you also configure the `Source IP` value to your Open Paging Server IP address for security. Adjust the `Volume` if needed. Click `Save and Apply` when finished. The device will reload.

![](chrome_XqnKFChPQj.png)

## Configure text scroll for visual messages

For clocks and signs, you can configure text and flashers for visual messages. 

First, set the `General Command Password` under `Network`. It's recommended to use a different one per device. You can also change the `HTTP Command Port` as well per clock. Make sure you write down the new port for each device with it's MAC address somewhere safe, since the web interface will also run on this port. 
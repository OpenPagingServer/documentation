
# Platform-specific optimizations

Open Paging Server can optimize how it's SIP stack behaves depending on the user-agent of a client. Optimizations are done to mitigate certain issues or bugs. This feature can be disabled in `System Settings` > `SIP` > `Platform-specific optimizations`.

### List of optimizations

| Platform (UA) | Change                                                    | Reason                                                                                                                             | OPS Versions |
| ------------- | --------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- | ------------ |
| Cisco-CUCM    | Only PCMU (ulaw) is advertised for early-media intercepts | CUCM does not play it's own intercept if the ended call was wideband, resulting in up to 10 seconds of silence before busy signal. | 0.7.0-       |
|               |                                                           |                                                                                                                                    |              |

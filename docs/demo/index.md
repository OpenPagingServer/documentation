# Open Paging Server Demo

The Open Paging Server Project operates a public demo server which can be used to evaluate the available features and user interface before installation available at https://demo.openpagingserver.org.

The performance of the demo server will not be representative of how it will run on your own system to due several factors. Including available resources, public traffic, and amount of users.

Please note that 

## Available Groups

The server is setup to replicate a school-district. With multiple campuses/buildings. Each group is named after a fictional building in this district. Each one different types of endpoints. You can use Multicast Gateway to receive multicast RTP for both generic streams and Polycom streams. Each also has it's own sets of bells.

| Group Name                       | Description                                                                                                                     | Sends to                                         |     |
| -------------------------------- | ------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------ | --- |
| Brian Amesbury Memorial Building | Polycom PTT Multicast                                                                                                           | 224.0.1.116:5001 Group 1                         |     |
| CSP Daycare                      |                                                                                                                                 | 277-7448 on CSP                                  |     |
| Discord pre-school               | Discord Webhook                                                                                                                 | Open Paging Server Discord: `#broadcasts-direct` |     |
| Power-outage Middle School       | This group has a bunch of offline Cisco IP Phones to show show offline devices are handled by Open Paging Server                | Nowhere. All endpoints are permanently offline.  |     |
| Y U DUMB? Elementary             | Generic Multicast RTP Stream. For use with Cisco SPA/MPP, Yealink, Grandstream, Snom, etc. Devices must be configured for PMCU. | 224.168.168.168:34560 PMCU                       |     |
| Waldo High School                | Generic Multicast RTP Stream. For use with Cisco SPA/MPP, Yealink, Grandstream, Snom, etc. Devices must be configured for PMCA. | 232.9.10.11:23456 PMCA                           |     |

A separate webhook is also present in the Open Paging Server Discord in `#broadcasts-monitor` that is configured as a monitor endpoint for all groups. All broadcasts sent to any group will be posted there.
## Connecting Multicast Gateway



# SIP Trunk Compatibility Matrix: VoIP servers

Below is a chart of SIP compatible Voice over Internet Protocol (VoIP) servers by manufacturer along with their current compatibility status as of the latest stable release of Open Paging Server. Refer to historical records for data collected on older versions of Open Paging Server.

Data is collected using independent testing by Open Paging Server project contributors. Test results below are not an endsorment of the Open Paging Server project by the manfuacter.

Compatible VoIP servers include PBXes/UC, Paging Servers, and SBC's/Media Gateways. When connected using a SIP trunk, Open Paging Server can exchange broadcasts and incoming DNs with the other VoIP server.

**Certified**: The manufacturer has formally certified Open Paging Server as compatible

**Working as intended**: Independent tests by project contributors have noted the system as working. This DOES NOT count as manufacturer endorsement.

**Working with issues**: Minor issues exist that don't effect everyday function or have easy workarounds.

**Not working**: Testing found that the server does not work or requires hard or major workarounds.

**Unsupported**: The server does not support Open Paging Server

This list only includes servers which have been tested. 

**The Open Paging Server Project nor its partners or staff does not endorse any product listed on this page. **Listed manufactures do not inherently sponsor or support the project.****


## Avaya


| Product      | Status                  |
| ------------ | ----------------------- |
| IP Office 11 | **Working as intended** |

## Cisco


| Product                           | Status                  |
| --------------------------------- | ----------------------- |
| Unified Communications Manager 15 | **Working as intended** |
| Unified Communications Manager 14 | **Working as intended** |
| Unified Communications Manager 12 | **Working as intended** |
| Unified Communications Manager 11 | **Working as intended** |

## Grandstream


| Product | Status                  |
| ------- | ----------------------- |
| UCM6301 | **Working as intended** |
| UCM6302 | **Working as intended** |
| UCM6304 | **Working as intended** |
| UCM6308 | **Working as intended** |

## MYVOIPAPP

| Product           | Status          | Note                                                                                                                                                                |
| ----------------- | --------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| miniSIPServer V70 | **Not working** | Was not able to get RTP working when Open Paging Server is connected as a "External Line". Even after enabling 'Relay Media Streams'. Tested with Yealink SIP-T46G. |


## Open Paging Server

| Product              | Status        |
| -------------------- | ------------- |
| Open Paging Server 0 | **Certified** |

## Sangoma/Digium


| Product                  | Status                  |
| ------------------------ | ----------------------- |
| Asterisk 18 (chan_pjsip) | **Working as intended** |
| Asterisk 19 (chan_pjsip) | **Working as intended** |
| Asterisk 20 (chan_pjsip) | **Working as intended** |
| Asterisk 21 (chan_pjsip) | **Working as intended** |
| Asterisk 22 (chan_pjsip) | **Working as intended** |
| Asterisk 23 (chan_pjsip) | **Working as intended** |
| FreePBX 15 (chan_pjsip)  | **Working as intended** |
| FreePBX 16 (chan_pjsip)  | **Working as intended** |
| FreePBX 17 (chan_pjsip)  | **Working as intended** |

## Singlewire


| Product                 | Status                  |
| ----------------------- | ----------------------- |
| InformaCast Advanced 14 | **Working as intended** |
| InformaCast Advanced 12 | **Working as intended** |



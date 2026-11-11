# Third-party SIP Devices on CUCM

You can use Lua scripts in CUCM to allow third-party SIP Devices registered to CUCM (e.g. Cisco SPA/MPP, Polycom, Yealink, Grandstream, Snom, Fanvil) to auto-answer pages from Open Paging Server. The script forwards the Alert-Info header from the Open Paging Server trunk to the phone as both Alert-Info and Call-Info. 

This easily establishes unicast audio to third-party SIP phones using it's directory number and does not depend on Open Paging Server having it's IP address, multicast, or the phone being directly reachable from Open Paging Server. 

Keep in mind that this is only recommended when only one telephone is on a directory number. As only one call will be created, so only the phone that answers the earliest will receive the page if more than one phone share the DN.

CUCM normally acts as a Back-to-Back User Agent (B2BUA) and does not forward arbitrary headers and replaces Alert-Info/Call-Info headers. This script bypasses that by changing the header while the call is processed in CUCM to allow it to be forwarded and then back for the end phone.

## Create Outbound Dial Endpoint

In Open Paging Server, `Manage Endpoints`, `+`, `SIP Trunks`, `Outbound Dial`.

Select your CUCM trunk under `SIP Trunk`. Under `Number`, enter the Directory Number of the phone. Ensure the Call Searching Space of the trunk in CUCM can reach the DN. Set the CID and CNAM depending on how you would like the call to show on the phone. Ensure mode is set to `Page`. Under `Alert-Info Header`, select the header used by the phone to auto answer calls. Refer to the vendors support or documentation for more information.

Click `Add SIP Number Endpoint`

## Create Lua Scripts

In `Cisco Unified CM Administration`, go to `Device` > `Device Settings` > `SIP Normalization Scripts`.

You will need to add 2 scripts.

### Trunk to CUCM

Click `Add New`

Name: `alertinfopassthrough-trunktocucm`

Content:

```
M = {}

M.allowHeaders = {"Alert-Info"}

function M.inbound_INVITE(msg)
    local alert = msg:getHeader("Alert-Info")

    if alert then
        local pt = msg:getPassThrough()
        pt:addHeader("X-Alert-Info", alert)
    end
end

return M
```

Click `Save`
### CUCM to Phone

Click `Add New`

Name: `alertinfopassthrough-cucmtophone`

Content

```
M = {}

M.allowHeaders = {"X-Alert-Info", "Alert-Info", "Call-Info"}

function M.outbound_INVITE(msg)
    local alert = msg:getHeader("X-Alert-Info")

    if alert then
        msg:removeHeader("X-Alert-Info")
        msg:modifyHeader("Alert-Info", alert)
        msg:modifyHeader("Call-Info", alert)
    end
end

return M
```

Click `Save`

## Assign Lua Script to Trunk

In `Cisco Unified CM Administration`, go to `Device` > `Trunk`

Click your Open Paging Server trunk.

Under `Normalization Script`, select `alertinfopassthrough-trunktocucm`.

Click `Save`.

## Assign Lua Script to SIP Profile

Since the default SIP profiles cannot be edited, you will need to create a new SIP profile and assign it to your phones. Such as a separate SIP profile for third party devices.

In `Cisco Unified CM Administration`, go to `Device` > `Device Settings` > `SIP Profile`.

Click `Find`.

If you have an existing SIP profile you already use for your third-party SIP phones, click it. Otherwise click `Standard SIP Profile`, click `Copy`, and rename it to something like `Third-party SIP Profile` and click `Save`.

Under `Normalization Script`, select `alertinfopassthrough-cucmtophone` and click `Save`.

If you already use another Normalization Script, you will need to merge the new one with your existing one into one script.

## Assign SIP Profile to Phones

In `Cisco Unified CM Administration`, go to `Device` > `Phone`.

Click your phone.

Under `Protocol Specific Information`, find `SIP Profile` and select your newly created SIP Profile.

Click `Save` then `Apply Config`.

## Testing

If configured correctly, any audio messages sent to the phone should be auto-answered and play through the speakerphone. If the phone only rings, ensure that your Alert-Info header is set properly per the vendor documentation. In the phones configuration, you also may need to enable a setting such as `Answer Pages`, `Allow Intercom`, `Auto-answer Paging`, etc.

## Phone configuration

### Polycom

### Yealink

### MicroSIP

Under the `▼` dropdown menu, click `Settings`.

Under `Auto Answer`, select `SIP Header`. 

Click `Save`.


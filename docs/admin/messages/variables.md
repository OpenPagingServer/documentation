# Variables

Variables let you insert dynamic information into a message. When you send a message with one or more variables, they are automatically replaced with it's relative information before getting pushed to the database. Variables are enclosed in `${}`. Some variables can also contain a parameter using a colon. 

Variables can be inserted into short messages, long messages, and text-to-speech. You can use the wizard by clicking the `${x} Insert Variables` button, or manually insert variables. 

Open Paging Sever includes a default set of everyday variables. Input endpoints/modules that allow custom messages can also have it's own set of variables relative to it's functionally. For example, the NWS API module has `${alertname}` and `${alerttext}`.

## Available Variables

### Date
### Date + Time

### Sender

`{$sender}` inserts the sender of the message. This can include the username, caller ID, or CNAM of the entity that sent the message.

### API

`${api}` allows text from an external source to be loaded. Insert a URL as the parameter. A plain text response is expected.

Example: `${api:https://api.doeuniversity.edu/tempature/performingartscenter/roof}`

Local, private, and loopback IP addresses are blocked by default for security. Even when using DNS name resolution. To allow these, insert ``OPS_MESSAGE_VARIABLE_API_ALLOW_PRIVATE=true`` into .env and restart Open Paging Server.

### Product Name

`${productname}` inserts the product name of the server as defined in branding settings. There are no parameters for this variable. 


## Examples

`Building lockdown at {$date+time} from ${sender}` could become 
`Building lockdown at 06/07/2026 03:00:00 PM from johndoe` or
`Building lockdown at 02/02/2027 09:41:21 AM from test`



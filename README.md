Author's Note:
--------------
BEFORE USING ANY CODE IN THESE SCRIPTS, READ THROUGH ALL FILES THOROUGHLY, UNDERSTAND WHAT THE SCRIPTS ARE DOING AND TEST THEIR BEHAVIOR IN AN ISOLATED ENVIRONMENT.  RESEARCH ANY POTENTIAL BUGS IN THE VERSION OF THE SOFTWARE YOU ARE USING THESE SCRIPTS WITH AND UNDERSTAND THAT FEATURE SETS OFTEN CHANGE FROM VERSION TO VERSION OF ANY PLATFORM WHICH MAY DEPRECATE CERTAIN PARTS OF THIS CODE.  ANY INDIVIDUAL CHARGED WITH RESPONSIBILITY IN THE MANAGEMENT OF A SYSTEM RUNS THE RISK OF CAUSING SERVICE DISRUPTIONS AND/OR DATA LOSS WHEN THEY MAKE ANY CHANGES AND SHOULD TAKE THIS DUTY SERIOUSLY AND ALWAYS USE CAUTION.  THIS CODE IS PROVIDED WITHOUT ANY WARRANTY WHATSOEVER AND IS INTENDED FOR EDUCATIONAL PURPOSES.  

Cisco Unified Communications Manager Gateway Stats Script
=========================================================
This script was written to address certain challenges in managing Cisco phones in a Cisco Unified Communications (CUCM) environment.  

Keeping abreast of capacity needs is a substantial part of maintaining a well running telecom environment.  Even after provisioning enough resources to handle inbound and outbound traffic for the network, it can be easy to lose sight of what you have provisioned and what you'll need to grow.

This script queries CUCM for information regarding PRI active channel usage on MGCP gateways.  It assumes 4 separate gateways and asks CUCM the question, "Do you have a gateway named gatewayX, and if you do does it have any channels in use".  From there, we gather information for each gateway.  Some math at the bottom of the script takes this information and provides some stats.  The script can be the basis for a wallboard that can, with the help of some javascript, turn the data into a pie chart to display how many channels out of the total are being used.  Also, the data can be added to a database table so that another script can pull this information and create a line chart of the minute-to-minute fluctuations.   

Tested on:
----------
* Debian 7
* PHP 5
* CUCM 10.5
* Cisco AXL Toolkit (specifically, the AXLAPI.wsdl file)
* An application user account on CUCM with the following privileges
  * Standard CCM Admin Users
  * Standard CCMADMIN Read Only
  * Standard Serviceability Read Only

<?php
/*IPN Sample code
=================
This code gets all the parameters of "IPN", checks if the request came from a plimus server (by IP) and saves the data to a file.
Then sends a notification to shopper's cell phone.
Revision: 05/25/2013
*/
$plimusIps = array("62.219.121.253","209.128.93.232", "209.128.64.62", "209.128.93.248", "72.20.107.242", "209.128.93.229", "209.128.93.98", "209.128.93.230", "209.128.93.245", "209.128.93.104", "209.128.93.105", "209.128.93.107", "209.128.93.108", "209.128.93.242", "209.128.93.243", "209.128.93.254", "62.216.234.216", "62.216.234.218", "62.216.234.219", "62.216.234.220", "127.0.0.1","localhost", "209.128.104.18", "209.128.104.19", "209.128.104.20", "209.128.104.21", "209.128.104.22", "209.128.104.23", "209.128.104.24", "209.128.104.25", "209.128.104.26", "209.128.104.27", "209.128.104.28", "209.128.104.29", "209.128.104.30", "209.128.104.31", "209.128.104.32", "209.128.104.33", "209.128.104.34", "209.128.104.35", "209.128.104.36", "209.128.104.37", "99.186.243.9", "99.186.243.10", "99.186.243.11", "99.186.243.12", "99.186.243.13", "99.180.227.233", "99.180.227.234", "99.180.227.235", "99.180.227.236", "99.180.227.237");

//Check if the request came from Plimus IP
if (array_search($_SERVER['REMOTE_ADDR'], $plimusIps) == false) {
exit($_SERVER['REMOTE_ADDR'] . " is not a plimus server!!!");
}

echo "pass IP";

//test
 $test = $_GET['referenceNumber'];
 if ($test == NULL){
 $test = $_POST['referenceNumber'];
}
echo "TEST = $test";


//Put IPN Parameters in local varibales
$transactionType = $_REQUEST['transactionType'];
$testMode = $_REQUEST['testMode'];
$referenceNumber = $_REQUEST['referenceNumber'];
$originalReferenceNumber = $_REQUEST['originalReferenceNumber'];
$subscriptionID = $_REQUEST['subscriptionId'];
$paymentMethod = $_REQUEST['paymentMethod'];
$creditCardType = $_REQUEST['creditCardType'];
$transactionDate = $_REQUEST['transactionDate'];
$untilDate = $_REQUEST['untilDate'];
$productId = $_REQUEST['productId'];
$productName = $_REQUEST['productName'];
$contractId = $_REQUEST['contractId'];
$contractName = $_REQUEST['contractName'];
$contractOwner = $_REQUEST['contractOwner'];
$contractPrice = $_REQUEST['contractPrice'];
$quantity = $_REQUEST['quantity'];
$currency = $_REQUEST['currency'];
$addCD = $_REQUEST['addCD'];
$coupon = $_REQUEST['coupon'];
$couponValue = $_REQUEST['couponValue'];
$referrer = $_REQUEST['referrer'];
$accountId = $_REQUEST['accountId'];
$title = $_REQUEST['title'];
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];
$company = $_REQUEST['company'];
$address1 = $_REQUEST['address1'];
$address2 = $_REQUEST['address2'];
$city = $_REQUEST['city'];
$state = $_REQUEST['state'];
$country = $_REQUEST['country'];
$zipCode = $_REQUEST['zipCode'];
$email = $_REQUEST['email'];
$workPhone = $_REQUEST['workPhone'];
$extension = $_REQUEST['extension'];
$mobilePhone = $_REQUEST['mobilePhone'];
$homePhone = $_REQUEST['homePhone'];
$faxNumber = $_REQUEST['faxNumber'];
$licenseKey = $_REQUEST['licenseKey'];
$shippingFirstName = $_REQUEST['shippingFirstName'];
$shippingLastName = $_REQUEST['shippingLastName'];
$shippingAddress1 = $_REQUEST['shippingAddress1'];
$shippingAddress2 = $_REQUEST['shippingAddress2'];
$shippingCity = $_REQUEST['shippingCity'];
$shippingState = $_REQUEST['shippingState'];
$shippingCountry = $_REQUEST['shippingCountry'];
$shippingZipCode = $_REQUEST['shippingZipCode'];
$remoteAddress = $_REQUEST['remoteAddress'];
$shippingMethod = $_REQUEST['shippingMethod'];
$couponCode = $_REQUEST['couponCode'];
$invoiceAmount = $_REQUEST['invoiceAmount'];
$invoiceInfoURL = $_REQUEST['invoiceInfoURL'];
$customfiels1 = $_REQUEST['cpuid'];
$authKey = $_REQUEST['authKey'];
$Company_name = $_REQUEST['Company_name'];

//Put IPN Promotions Parameters in local arrays
$promoteContractsNum = $_REQUEST['promoteContractsNum'];
for ($i=0; $i<$promoteContractsNum; $i++)
{
$promoteContracts[$i]['promoteContractId']= $_REQUEST["promoteContractId$i"];
$promoteContracts[$i]['promoteContractName'] = $_REQUEST["promoteContractName$i"];
$promoteContracts[$i]['promoteContractOwner'] = $_REQUEST["promoteContractOwner$i"];
$promoteContracts[$i]['promoteContractPrice'] = $_REQUEST["promoteContractPrice$i"];
$promoteContracts[$i]['promoteContractQuantity'] = $_REQUEST["promoteContractQuantity$i"];
$promoteContracts[$i]['promoteContractLicenseKey'] = $_REQUEST["promoteContractLicenseKey$i"];
}

//Add all parameters to a string
$now = date('m/d/Y H:i:s');

//heredoc: http://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
$txt = <<<ENDOFTEXT

<<<================= $now - Plimus Order: #$referenceNumber ==================>>>

transactionType: $transactionType
testMode: $testMode
referenceNumber: $referenceNumber
originalReferenceNumber: $originalReferenceNumber
subscriptionID: $subscriptionID
paymentMethod: $paymentMethod
creditCardType: $creditCardType
transactionDate: $transactionDate
untilDate: $untilDate
productId: $productId
productName: $productName
contractId: $contractId
contractName: $contractName
contractOwner: $contractOwner
contractPrice: $contractPrice
quantity: $quantity
currency: $currency
addCD: $addCD
coupon: $coupon
couponValue: $couponValue
referrer: $referrer
promoteContractsNum: $promoteContractsNum
accountId: $accountId
title: $title
firstName: $firstName
lastName: $lastName
company: $company
address1: $address1
address2: $address2
city: $city
state: $state
country: $country
zipCode: $zipCode
email: $email
workPhone: $workPhone
extension: $extension
mobilePhone: $mobilePhone
homePhone: $homePhone
faxNumber: $faxNumber
licenseKey: $licenseKey
shippingFirstName: $shippingFirstName
shippingLastName: $shippingLastName
shippingAddress1: $shippingAddress1
shippingAddress2: $shippingAddress2
shippingCity: $shippingCity
shippingState: $shippingState
shippingCountry: $shippingCountry
shippingZipCode: $shippingZipCode
remoteAddress: $remoteAddress
shippingMethod: $shippingMethod
couponCode: $couponCode
invoiceAmount: $invoiceAmount
invoiceInfoURL: $invoiceInfoURL
customfiels1: $customfiels1
authKey: $authKey
Company_name: $Company_name
ENDOFTEXT;

//Add Promotions Text to string
for ($i=0; $i<$promoteContractsNum; $i++)
{
$promotion = $promoteContracts[$i];
$txt .= "\r\n +promotion $i: ";
$txt .= "\r\n promoteContractId $i:" . $promoteContracts[$i]['promoteContractId'];
$txt .= "\r\n promoteContractName $i:" . $promoteContracts[$i]['promoteContractName'];
$txt .= "\r\n promoteContractOwner $i:" . $promoteContracts[$i]['promoteContractOwner'];
$txt .= "\r\n promoteContractPrice $i:" . $promoteContracts[$i]['promoteContractPrice'];
$txt .= "\r\n promoteContractQuantity $i:" . $promoteContracts[$i]['promoteContractQuantity'];
$txt .= "\r\n promoteContractLicenseKey $i:" . $promoteContracts[$i]['promoteContractLicenseKey'];
}

$txt .= "\r\n<<<================= End Of Plimus Order: #$referenceNumber ==================>>> \r\n";

//echo($txt);

//Print IPN Parameters to File Named "Plimus_IPN.log"
$file = 'Plimus_IPN.log';

// Open the file to get existing content
$current = file_get_contents($file);

// Append a new person to the file
$current .= $txt;

// Write the contents back to the file
file_put_contents($file, $current);

/*send email to shopper's mobil phone*/
/* major carrier list: http://www.howstuffworks.com/e-mail-messaging/how-to-send-text-messages-computer.htm, http://www.computerhope.com/issues/ch000952.htm
AT&T customers using @txt.att.net.
Alltel: @message.alltel.com
Nextel: @messaging.nextel.com
Sprint: @messaging.sprintpcs.com
SunCom: @tms.suncom.com
T-mobile: @tmomail.net
VoiceStream: @voicestream.net
Verizon: @vtext.com (text only) or @vzwpix.com (photos and video) [source: Slipstick Systems].

3 River Wireless -  @sms.3rivers.net
Alltel -  @message.alltel.com
AT&T -  @txt.att.net
ACS Wireless -  @paging.acswireless.com
Bell Canada -  @txt.bellmobility.ca
Bell Mobility (Canada) -  @txt.bell.ca
Bell Mobility -  @txt.bellmobility.ca
Blue Sky Frog -  @blueskyfrog.com
Bluegrass Cellular -  @sms.bluecell.com
Boost Mobile -  @myboostmobile.com
BPL Mobile -  @bplmobile.com
Carolina West Wireless - 10digit10digitnumber@cwwsms.com
Cellular One -  @mobile.celloneusa.com
Cellular South -  @csouth1.com
Centennial Wireless -  @cwemail.com
CenturyTel -  @messaging.centurytel.net
Cingular -  @txt.att.net
Clearnet -  @msg.clearnet.com
Comcast -  @comcastpcs.textmsg.com
Corr Wireless Communications -  @corrwireless.net
Dobson -  @mobile.dobson.net
Edge Wireless -  @sms.edgewireless.com
Fido -  @fido.ca
Golden Telecom -  @sms.goldentele.com
Helio -  @messaging.sprintpcs.com
Houston Cellular -  @text.houstoncellular.net
Illinois Valley Cellular -  @ivctext.com
Inland Cellular Telephone -  @inlandlink.com
Idea Cellular -  @ideacellular.net
MCI -  @pagemci.com
Metrocall -  @page.metrocall.com
Metrocall 2-way -  @my2way.com
Metro PCS -  @mymetropcs.com
Microcell -  @fido.ca
Midwest Wireless -  @clearlydigital.com
Mobilcomm -  @mobilecomm.net
MTS -  @text.mtsmobility.com
Nextel -  @messaging.nextel.com
OnlineBeep -  @onlinebeep.net
Presidents Choice -  @txt.bell.ca
Public Service Cellular -  @sms.pscel.com
PCS One -  @pcsone.net
Qwest -  @qwestmp.com
Rogers Canada -  @pcs.rogers.com
Rogers AT&T Wireless -  @pcs.rogers.com
Satellink -  .pageme@satellink.net
Southwestern Bell -  @email.swbw.com
Sprint -  @messaging.sprintpcs.com
Sumcom -  @tms.suncom.com
Surewest Communicaitons -  @mobile.surewest.com
Sumcom -  @tms.suncom.com
Sprint -  @messaging.sprintpcs.com
Solo Mobile -  @txt.bell.ca
Surewest Communicaitons -  @mobile.surewest.com
T-Mobile -  @tmomail.net
Tracfone -  @txt.att.net
Telus -  @msg.telus.com
Triton -  @tms.suncom.com
Unicel -  @utext.com
US Cellular -  @email.uscc.net
US West -  @uswestdatamail.com
Virgin Mobile -  @vmobl.com
Virgin Mobile Canada -  @vmobile.ca
Verizon -  @vtext.com
Western Wireless -  @cellularonewest.com
West Central Wireless -  @sms.wcc.net
*/
$phoneDomain = array("@messaging.sprintpcs.com", "@txt.att.net", "@tmomail.net", "@vtext.com","@vmobl.com");

foreach($phoneDomain as $value){
	if ($transactionType==='CHARGE') {
	
	      $fromEmail="merchants@bluesnap.com";
	      $headers.="Reply-to: $fromEmail\n";
	      $headers .= "From: $fromEmail\n"; 
	      $headers .= "Errors-to: $fromEmail\n";
	      $headers = "Content-Type: text/html; charset=iso-8859-1\n".$headers;
	      if(mail(
	      $workPhone.$value,
	      "Mobile Confirmation",
	      "Dear ".$firstName.", order total: ".$invoiceAmount." has been charged to your ".$creditCardType." Invoice#: ".$referenceNumber.
	      "Thank You, Bluesnap.com"
	      ,"$headers")){
	      	echo "SENT";
	      }
	      else{echo "NOTSEND";}
	}
}
?>
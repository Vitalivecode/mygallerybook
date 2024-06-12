<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Calcutta');

class Subscription extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('insertdata');
		$this->load->model('getdata');
	}
	
	public function index(){
	    
	    $subscription = $this->getdata->subscription("All");
	    $subscriptionData = array();
	    foreach($subscription as $row):
	        if($row->sStatus == 1){
	            $subscriptionData[] = $row;
	        }
        endforeach;
        
	    $this->output
			->set_content_type('application/json')
			->set_output(json_encode($subscriptionData));
	}
	
	public function index2(){
	    
	    $subscription = $this->getdata->subscription("All");
	    $subscriptionData = array();
	    foreach($subscription as $row):
	        if($row->sStatus == 1){
	            $subscriptionData[] = $row;
	        }
        endforeach;
        
        $template = $this->getdata->template("All");
	    $templateData = array();
	    foreach($template as $row):
	        if($row->tStatus == 1){
	            $templateData[] = $row;
	        }
        endforeach;
        $data["SubscriptionData"] = $subscriptionData;
        $data["TemplateData"] = $templateData;
	    $this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
	
	public function add(){
	    $subscriptionData = array(
	        'sName' => $this->input->post('sName'),
	        'sMonths' => $this->input->post('sMonths'),
	        'sAlbums' => $this->input->post('sAlbums'),
	        'sCost' => $this->input->post('sCost'),
	        'sOfferCost' => $this->input->post('sOfferCost'),
	        'sDescription' => $this->input->post('sDescription'),
	        'sStatus' => 1,
	        'createdAt' => date('Y-m-d H:i:s'),
	        'modifiedAt' => date('Y-m-d H:i:s')
	        );
	        
	        $subscription = $this->insertdata->subscription($subscriptionData);
	        $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode($subscription));
	}
	
	public function edit(){
	    $subscriptionData = array(
	        'sName' => $this->input->post('sName'),
	        'sMonths' => $this->input->post('sMonths'),
	        'sAlbums' => $this->input->post('sAlbums'),
	        'sCost' => $this->input->post('sCost'),
	        'sOfferCost' => $this->input->post('sOfferCost'),
	        'sDescription' => $this->input->post('sDescription'),
	        'createdAt' => date('Y-m-d H:i:s'),
	        'modifiedAt' => date('Y-m-d H:i:s')
	        );
	        
	        $subscription = $this->insertdata->subscriptionedit($subscriptionData,$this->input->post('sId'));
	        $this->output
	                ->set_content_type('application/json')
	                ->set_output(json_encode($subscription));
	}
	
	public function active(){
	    $sId = $this->input->post('sId');
        if($this->input->post('sStatus') == 1){
            $sStatus = 0;
        }
        else if($this->input->post('sStatus') == 0){
            $sStatus = 1;
        }
        else if($this->input->post('sStatus') == 2){
            $sStatus = 2;
        }
        $result = $this->insertdata->subscriptionactive($sId,$sStatus,date('Y-m-d H:i:s'));
		if($result){
			redirect('o/subscriptions');
		}
    }
	
	public function pack(){
	    $packData = array(
	        'cId' => $this->input->post('cId')
	        );
	    $subscriptionPack = $this->getdata->pack($packData);
	    
	    $this->output
		        ->set_content_type('application/json')
		        ->set_output(json_encode($subscriptionPack));
	}
	
	public function packBuy(){
	    $sMonths = $this->input->post('sMonths');
	    $sEndDate = date('Y-m-d');
	    $sEndDate = date('Y-m-d', strtotime($sEndDate . "+".$sMonths." months"));
	    $packCheck = $this->getdata->packCheck($this->input->post('cId'));
	    if(count($packCheck)==0){
	        $packData = array(
	        'cId' => $this->input->post('cId'),
	        'sId' => $this->input->post('sId'),
	        'sEndDate' => $sEndDate,
	        'sRemainAlbums' => $this->input->post('sRemainAlbums'),
	        'amountPaid' => $this->input->post('amountPaid'),
	        'transactionID' => $this->input->post('transactionID'),
	        'pStatus' => 1,
	        'paymentAt' => date('Y-m-d H:i:s')
	        );
	        
	        $subscriptionPack = $this->insertdata->pack($packData);
	        $this->output
	            ->set_content_type('application/json')
		        ->set_output(json_encode($subscriptionPack));
	    }
	    else{
	        $this->output
	            ->set_content_type('application/json')
		        ->set_output("Already you Have Subcription Pack");
	    }
	    
	}
	
	public function pdfTest(){
	    $html_content = '<h3 align="center">Convert HTML to PDF in CodeIgniter using Dompdf</h3>';
	    $html_content .= '
	    <div class="invoice-body">
                <div class="pull-left">
                  <h1>DASHIO</h1>
                  <address>
                <strong>Admin Theme, Inc.</strong><br>
                795 Asome Ave, Suite 850<br>
                New York, 94447<br>
                <abbr title="Phone">P:</abbr> (123) 456-7890
              </address>
                </div>
                <!-- /pull-left -->
                <div class="pull-right">
                  <h2>invoice</h2>
                </div>
                <!-- /pull-right -->
                <div class="clearfix"></div>
                <br>
                <br>
                <br>
                <div class="row">
                  <div class="col-md-9">
                    <h4>Paul Smith</h4>
                    <address>
                  <strong>Enterprise Corp.</strong><br>
                  234 Great Ave, Suite 600<br>
                  San Francisco, CA 94107<br>
                  <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
                  </div>
                  <!-- /col-md-9 -->
                  <div class="col-md-3">
                    <br>
                    <div>
                      <div class="pull-left"> INVOICE NO : </div>
                      <div class="pull-right"> 000283 </div>
                      <div class="clearfix"></div>
                    </div>
                    <div>
                      <!-- /col-md-3 -->
                      <div class="pull-left"> INVOICE DATE : </div>
                      <div class="pull-right"> 15/03/14 </div>
                      <div class="clearfix"></div>
                    </div>
                    <!-- /row -->
                    <br>
                    <div class="well well-small green">
                      <div class="pull-left"> Total Due : </div>
                      <div class="pull-right"> 8,000 USD </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                  <!-- /invoice-body -->
                </div>
                <!-- /col-lg-10 -->
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width:60px" class="text-center">QTY</th>
                      <th class="text-left">DESCRIPTION</th>
                      <th style="width:140px" class="text-right">UNIT PRICE</th>
                      <th style="width:90px" class="text-right">TOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">1</td>
                      <td>Flat Pack Heritage</td>
                      <td class="text-right">$429.00</td>
                      <td class="text-right">$429.00</td>
                    </tr>
                    <tr>
                      <td class="text-center">2</td>
                      <td>Carry On Suitcase</td>
                      <td class="text-right">$300.00</td>
                      <td class="text-right">$600.00</td>
                    </tr>
                    <tr>
                      <td colspan="2" rowspan="4">
                        <h4>Terms and Conditions</h4>
                        <p>Thank you for your business. We do expect payment within 21 days, so please process this invoice within that time. There will be a 1.5% interest charge per month on late invoices.</p>
                        <td class="text-right"><strong>Subtotal</strong></td>
                        <td class="text-right">$1029.00</td>
                    </tr>
                    <tr>
                      <td class="text-right no-border"><strong>Shipping</strong></td>
                      <td class="text-right">$0.00</td>
                    </tr>
                    <tr>
                      <td class="text-right no-border"><strong>VAT Included in Total</strong></td>
                      <td class="text-right">$0.00</td>
                    </tr>
                    <tr>
                      <td class="text-right no-border">
                        <div class="well well-small green"><strong>Total</strong></div>
                      </td>
                      <td class="text-right"><strong>$1029.00</strong></td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <br>
              </div>
	    ';
	    $this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$this->pdf->stream("test.pdf", array("Attachment"=>0));
			
			$to = "swamyakunoori.coign@gmail.com"; 
$from = "swan.my88@gmail.com"; 
$subject = "MyGallerybook"; 
$message = "<p>Please see the attachment.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "test.pdf";

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
/*$body .= "This is a MIME encoded message.".$eol;
*/

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
mail($to, $subject, $body, $headers);
	}
	
	public function mailTest(){
	    
	  $this->load->library('email');
      $this->email->from('swamyakunoori.coign@gmail.com', 'Swamy');
      $this->email->to('swamyakunoori.coign@gmail.com');
      $this->email->subject('This is my subject');
      $this->email->message('This is my message');
      $this->email->send();
        
	}
	
}
?>
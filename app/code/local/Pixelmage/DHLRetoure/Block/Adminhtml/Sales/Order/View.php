<?php

class Pixelmage_DHLRetoure_Block_Adminhtml_Sales_Order_View extends Mage_Adminhtml_Block_Sales_Order_View {
    
    public function  __construct() {
    
    $order_id = Mage::helper('sales')->__($this->getOrder()->getRealOrderId());
	
	$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
	$query_sales = $connection->select('entity_id, increment_id')->from('sales_flat_order')->where('increment_id='.$order_id);

	$row_sales = $connection->fetchRow($query_sales);
	
	$enity_id = $row_sales['entity_id'];
	
	$query_adress = $connection->select('parent_id, firstname, lastname, company, email, postcode, street, city')->from('sales_flat_order_address')->where('parent_id='.$enity_id.'&& address_type="shipping"');

	$row_adress = $connection->fetchRow($query_adress);
	
	$search = array ("ä", "Ä", "ö", "Ö", "ü", "Ü", "ß");
	$replace = array ("%E4", "%C4", "%F6", "%D6", "%FC", "%DC", "%DF");
	
	$firstname = str_replace($search,$replace,$row_adress['firstname']);
	$lastname = str_replace($search,$replace,$row_adress['lastname']);
	
	$name = $firstname.' '.$lastname;
	
	$email = str_replace($search,$replace,$row_adress['email']);
	$company = str_replace($search,$replace,$row_adress['company']);
	$street = str_replace($search,$replace,$row_adress['street']);
	$postcode = str_replace($search,$replace,$row_adress['postcode']);
	$city = str_replace($search,$replace,$row_adress['city']);


	$url = "Copy your DHL URL here!"; #Something like https://XXX.dpwn.net/abholportal/123/customer/RpOrder.action?delivery=LAGER
	
        parent::__construct();
        
        	$this->_addButton('order_reorder', array(
                        'label'     => Mage::helper('sales')->__('Retoure'),
                        'onclick'   => "setLocation('".$url."&ADDR_SEND_STREET_ADD=Retoure ".$order_id."&ADDR_SEND_LAST_NAME=".$name."&ADDR_SEND_NAME_ADD=".$company."&ADDR_SEND_STREET=".$street."&ADDR_SEND_ZIP=".$postcode."&ADDR_SEND_CITY=".$city."&ADDR_SEND_EMAIL=".$email."')"
        	));
    }
}

?>
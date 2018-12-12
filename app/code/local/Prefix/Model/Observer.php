<?php
class Ebiz_Prefix_Model_Observer
{

			public function orderPrefix(Varien_Event_Observer $observer)
			{
				$order = $observer->getEvent()->getOrder();
				$payment = $order->getPayment()->getMethodInstance()->getCode();
				$incrementId = $order->getIncrementId();
				$storeId = $order->getStoreId();
				$storeName = $order->getStoreName();
				
				if($storeId == 16){
					if($payment == "catchfeederpayment"){
						if(is_numeric($incrementId)){
							$new_incrementId = 'COTD'.$incrementId;
							$order->setIncrementId($new_incrementId);	
						}else{
							$order->setIncrementId($incrementId);
						}						
					}else{
						if(is_numeric($incrementId)){
							$new_incrementId = 'WLP'.$incrementId;
							$order->setIncrementId($new_incrementId);	
						}else{
							$order->setIncrementId($incrementId);
						}		
					}
				}

				if($storeId == 18){
						if(is_numeric($incrementId)){
							$new_incrementId = 'GUM'.$incrementId;
							$order->setIncrementId($new_incrementId);	
						}else{
							$order->setIncrementId($incrementId);
						}
				}
									
				Mage::log(  '<br><br><br><br><br><br>Catchfeeder order place
        				<br/>--old---'.$incrementId
        				.'<br/>--new---'.$new_incrementId
        				.'<br/>--payment---'.$payment
        				.'<br/>--storeid---'.$storeId
        				.'<br/>--storename---'.$storeName,
						null, 
						'catchfeeder'.date("Y-m-d-h").'.log',true);
			}
		
}

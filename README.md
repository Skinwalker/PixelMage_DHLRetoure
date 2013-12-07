PixelMage_DHLRetoure
====================

Add a button to the Sales Order View Page which will link to the DHLRetoure Site with prefilled values for the customer.
Vales are used from the shippingadress.

How to install:
- Copy the content into your Magento Directory
- Edit view.php in app/local/Pixelmage/DHLRetoure/Block/Adminhtml/Sales/Order and insert the URL you get from DHL into $url.
- Save and flush caches

Open a random order page - notice the new button "Retoure" on the Top-Button-Area - click it - MAGIC!


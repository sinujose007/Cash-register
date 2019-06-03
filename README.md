
PROJECT NAME :  CASH REGISTER CONNECTION

# FRAMEWORK :  CODEIGNITER
# DATABASE :  MYSQL
------------------------------------------------------------------------------

DESCRIPTION : Goal of this project is to create REST API methods , which can use by cash registers to manage the products and receipts through API.

INSTALLATION
-----------------------
 1. DOWNLOAD THE PROJECT FOLDER AND SAVE IN A ROOT FOLDER OF WAMP, XAMPP OR ANY SERVER YOU WISH
 2. CHANGE APPLICATION/CONFIG/DATABASE.PHP ,   MODIFY WITH YOUR SETTINGS, USERNAME, PASSWORD AND DBNAME
 3. DOWNLOAD THE CREGISTER.SQL AND RUN THE QUERIES INSIDE YOUR DATABASE FOR CREATING TABLES.
 4. VISIT THE PROJECT URL THROUGH BROWSER
 
 CREDENTIALS
 ----------------------
 
 UNDER THIS PROJECT 2 ROLES ARE AVAILABEL.
 
 1. ADMIN
         USERNAME :  sinu 
	     PASSWORD :  12345
	 
 2. CASHIER
         username :  user1 OR cash2
		 PASSWORD : 12345
		 
ADMIN FEATURES
---------------------------
1. Create User.
2. List User.
3. Create Product.
4. List Product.
5. List Receipts.
6. List Products Under Receipts.
7. Remove product from uncompleted Receipt.

CASHIER/USERNAME
-------------------------------

1. Create Receipt
2. List Receipts.
3. Add products to Receipt.
4. List products under each receipt.
4. Modify Product cost from unfinished Receipt.
5. Finish a  receipt.
6. Print receipt as PDF.



API METHODS & PARAMETERS
------------------------------------------------

ALL METHODS ARE USING POST.
AUTHORIZATION  :  THIS API IS NOW CHECKING ONLY USERNAME , NEEDS TO EXTEND WITH OAUTH 2

1. Create a New Product.
  
   /*
	* API METHOD : http://localhost/cash_register/rest/api/createProduct
	* METHOD : POST
	* PARAMETERS : DATA ARRAY [ BARCODE, PRODUCT_NAME, PRODUCT_COST, VAT_FK }, username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
----------------------------------------------------------------------------------------------------------	

2. get all Products

	/*
	* API METHOD : http://localhost/cash_register/rest/api/getProducts
	* METHOD : POST
	* PARAMETERS :username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
------------------------------------------------------------------------------------------------------------

3. get Product by Barcode	

	/*
	* API METHOD : http://localhost/cash_register/rest/api/getSingleProduct
	* METHOD : POST
	* PARAMETERS : data[BARCODE], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
-------------------------------------------------------------------------------------------------------------	

4. Create a new Receipt
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/createReceipt
	* METHOD : POST
	* PARAMETERS : data[CREATE_USER_PK,STATUS,CREATE_DATE], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
------------------------------------------------------------------------------------------------------------------

5. get All Receipts
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/getReceipts
	* METHOD : POST
	* PARAMETERS : data[CREATE_USER_PK], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
-------------------------------------------------------------------------------------------------------------------

6. Add product under receipt	
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/addReceiptProduct
	* METHOD : POST
	* PARAMETERS : data[CREATED_DATE,RECEIPT_FK,PRODUCT_FK], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
------------------------------------------------------------------------------------------------------------------

7. get all products under a receipt
	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/getProductsReceipts
	* METHOD : POST
	* PARAMETERS : data[CREATE_USER_PK,RECEIPT_PK], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
-------------------------------------------------------------------------------------------------------------------

8.  Modify product cost

	/*
	* API METHOD : http://localhost/cash_register/rest/api/getModifyProductCost
	* METHOD : POST
	* PARAMETERS : data[PRODUCT_PK,RECEIPT_PK, COST], username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
---------------------------------------------------------------------------------------------------------------------

9. Finish a receipt	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/completeReceipt
	* METHOD : POST
	* PARAMETERS : data[STATUS,RECEIPT] username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
-----------------------------------------------------------------------------------------------------------------------

10. Remove Product from receipt	
	/*
	* API METHOD : http://localhost/cash_register/rest/api/removeProductsReceipts
	* METHOD : POST
	* PARAMETERS : data[PRODUCT_PK,RECEIPT_PK] username, password
	* RESPONSE : HTTP_STATUS: 200 , 400, 401
	*/
	
--------------------------------------------------------------------------------------------------------------------------
	

     




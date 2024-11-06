# code-test

//
*Email: admin@gmail.com 
*Password: password
*Role: admin

//Project Run
*php artisan migrate
*php artisan db:seed
*php artisan serve
*php artisan storage:link 


// GetData with API
 * localhost:8000/api/company/list (Get method)
 * localhost:8000/api/employee/list (Get method)

 //  Create Data
 * localhost:8000/api/create/company (POST Method)
 * localhost:8000/api/create/employee (POST Method)
 
 //  Delete Data
 * localhost:8000/api/delete/company/{id}  (Get method)
 * localhost:8000/api/delete/employee/{id}  (Get method)
 
 // Update
 *localhost:8000/api/company/update (POST Method)

// Detail of data
 * localhost:8000/api/detail/company/{id} (Get Method)

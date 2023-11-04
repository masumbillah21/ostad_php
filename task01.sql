--Task 1
SELECT o.*, cu.customer_name
FROM orders AS o 
INNER JOIN customers AS cu ON o.customer_id = cu.customer_id;
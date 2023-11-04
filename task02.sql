--Task 2
SELECT p.*, ca.category_name
FROM products AS p
LEFT JOIN categories AS ca ON p.category_id = ca.category_id;
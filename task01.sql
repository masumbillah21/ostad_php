SELECT c.customer_id, c.name, c.email, c.location, 
       COUNT(o.order_id) AS total_orders
FROM Customers AS c
LEFT JOIN Orders AS o ON c.customer_id = o.customer_id
GROUP BY c.customer_id
ORDER BY total_orders DESC;
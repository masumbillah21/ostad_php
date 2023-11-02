SELECT c.name AS customer_name, 
       SUM(oi.quantity * oi.unit_price) AS total_purchase_amount
FROM Customers AS c
INNER JOIN Orders AS o ON c.customer_id = o.customer_id
INNER JOIN Order_Items AS oi ON o.order_id = oi.order_id
GROUP BY c.name
ORDER BY total_purchase_amount DESC
LIMIT 5;
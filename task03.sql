SELECT c.name AS category_name, 
       SUM(oi.quantity * oi.unit_price) AS total_revenue
FROM Categories AS c
INNER JOIN Products AS p ON c.category_id = p.category_id
INNER JOIN Order_Items AS oi ON p.product_id = oi.product_id
GROUP BY c.name
ORDER BY total_revenue DESC;
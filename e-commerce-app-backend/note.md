# category

id name mm_name slug

# product

id category_id supplier_id brand_id name slug image qty buy_price sale_price discount_price view_count like_count description

# brand

id name slug

# Color

id name slug

# Product_Color

# Supplier

id name image description

# product_add_transaction

id product_id supplier_id qty total_price

# product_remove_transaction

id product_id qty description

# product_cart

id user_id product_id qty total_price

# product_order

id user_id product_id qty total_price status[]

# product_reviews

id product_id rating review description

# income

id title amount description

# outcome

id title amount description

# noti_admin

id type comment seen

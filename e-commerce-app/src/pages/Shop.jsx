import { useEffect } from "react";
import { useProducts } from "../feature/product/useProducts";
import { useInView } from "react-intersection-observer";
import ProductItem from "../feature/product/ProductItem";
import BreadCrums from "../ui/BreadCrums";
import SelectionBox from "../ui/SelectionBox";
import Select from "../ui/Select";
import Container from "../ui/Container";
import Spinner from "../ui/Spinner";
import { useCategories } from "../feature/category/useCategories";
import { useUserProductLikes } from "../feature/user/useUserProductLikes";
import { useContextProvider } from "../context/ContextProvider";
import { useBrands } from "../feature/brand/useBrands";
import { useUserCarts } from "../feature/cart/useUserCarts";

function Shop() {
  const { token } = useContextProvider();
  const { ref, inView } = useInView();

  const { data, isLoading, fetchNextPage, isFetchingNextPage, hasNextPage } =
    useProducts();

  const { data: categories, isLoading: isLoading1 } = useCategories();

  const { data: brands, isLoading: isLoading3 } = useBrands();

  const {
    data: productLikes,
    isLoading: isLoading2,
    isFetching,
  } = useUserProductLikes(token);

  const { data: carts, isLoading: isLoading4 } = useUserCarts(token);

  const products =
    data?.pages
      .map((pages) => pages)
      .reduce((acc, cur) => [...acc, ...cur.data], []) || [];

  useEffect(() => {
    if (inView && hasNextPage && !isFetchingNextPage) fetchNextPage();
  }, [inView, hasNextPage, fetchNextPage, isFetchingNextPage]);

  if (isLoading1 || isLoading2 || isLoading3)
    return (
      <div className="mt-6">
        <Spinner />
      </div>
    );

  return (
    <Container>
      <div className="my-4">
        <BreadCrums />
      </div>
      <div className="grid grid-cols-[auto_1fr] gap-6">
        <div>
          <SelectionBox categories={categories} brands={brands} />
        </div>
        <div>
          <div className="mb-4 flex items-center justify-between">
            <Select
              options={[
                {
                  label: "Sort by date (recent first)",
                  value: "date-desc",
                },
                {
                  label: "Sort by date (late first)",
                  value: "date-asc",
                },
                {
                  label: "Sort by price (low to high)",
                  value: "price-asc",
                },
                {
                  label: "Sort by price (high to low)",
                  value: "price-desc",
                },
              ]}
              storageValue="sortby"
            />
          </div>
          <div className={`grid grid-cols-3 gap-8`}>
            {products.map((product) => (
              <ProductItem
                key={product?.id}
                product={product}
                productLikes={productLikes}
                carts={carts}
                isLoading={isFetching}
              />
            ))}
            {(isLoading || isFetchingNextPage) && (
              <div className="col-span-3 grid">
                <Spinner />
              </div>
            )}
            <div ref={ref}></div>
          </div>
        </div>
      </div>
    </Container>
  );
}

export default Shop;

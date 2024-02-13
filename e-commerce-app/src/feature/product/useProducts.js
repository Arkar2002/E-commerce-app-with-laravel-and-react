import { useInfiniteQuery } from "@tanstack/react-query";
import { getProducts } from "../../services/apiProduct";
import { useSearchParams } from "react-router-dom";

export function useProducts() {
  const [searchParams] = useSearchParams();

  const currentSortByValue = searchParams.get("sortby") || "date-desc";
  const currentCategoryValue = searchParams.get("categories") || "";
  const currentBrandValue = searchParams.get("brands") || "";

  const sortbyName = {
    date: "created_at",
    price: "sale_price",
  };

  const [field, direction] = currentSortByValue.split("-");

  const sortBy = {
    field: sortbyName[field],
    direction,
  };

  const {
    data,
    isLoading,
    error,
    fetchNextPage,
    hasNextPage,
    isFetchingNextPage,
  } = useInfiniteQuery({
    queryKey: ["products", sortBy, currentCategoryValue, currentBrandValue],
    queryFn: ({ pageParam }) =>
      getProducts(pageParam, sortBy, currentCategoryValue, currentBrandValue),
    initialPageParam: 1,
    getNextPageParam: (data) => {
      const currentPage = data.meta.current_page;
      const lastPage = data.meta.last_page;
      return currentPage < lastPage ? currentPage + 1 : undefined;
    },
  });

  return {
    data,
    isLoading,
    error,
    fetchNextPage,
    hasNextPage,
    isFetchingNextPage,
  };
}

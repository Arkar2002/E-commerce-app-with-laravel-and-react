import { useQuery } from "@tanstack/react-query";
import { useParams } from "react-router-dom";
import { getProductDetails } from "../../services/apiProduct";

export function useProductDetails() {
  const { productSlug } = useParams();

  const { data, isLoading, error } = useQuery({
    queryKey: [productSlug],
    queryFn: () => getProductDetails(productSlug),
  });

  return { data, isLoading, error };
}

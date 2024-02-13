import { useQuery } from "@tanstack/react-query";
import { getCarts } from "../../services/apiProduct";

export function useUserCarts(token) {
  const { data, isLoading, error } = useQuery({
    queryKey: ["carts"],
    queryFn: getCarts,
    enabled: Boolean(token),
  });

  return { data, isLoading, error };
}

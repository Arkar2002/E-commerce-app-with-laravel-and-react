import { useQuery } from "@tanstack/react-query";
import { getUserProductLikes } from "../../services/apiUser";

export function useUserProductLikes(token) {
  const { data, isLoading, error, isFetching } = useQuery({
    queryKey: ["product-likes"],
    queryFn: getUserProductLikes,
    enabled: Boolean(token),
  });

  return { data, isLoading, error, isFetching };
}

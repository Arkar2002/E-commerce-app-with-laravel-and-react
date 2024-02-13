import { useQuery } from "@tanstack/react-query";
import { getBrands } from "../../services/apiBrand";

export function useBrands() {
  const { data, isLoading, error } = useQuery({
    queryKey: ["brands"],
    queryFn: getBrands,
  });

  return { data, isLoading, error };
}

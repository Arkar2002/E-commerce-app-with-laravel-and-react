import { useQuery } from "@tanstack/react-query";
import { getCategories } from "../../services/apiCategory";

export function useCategories() {
  const { data, isLoading, error } = useQuery({
    queryKey: ["categories"],
    queryFn: getCategories,
  });

  return { data, isLoading, error };
}

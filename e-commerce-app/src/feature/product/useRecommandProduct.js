import { useQuery } from "@tanstack/react-query";
import { getRecommand } from "../../services/apiHome";

export function useRecommandProduct() {
  const { data, isLoading, error } = useQuery({
    queryKey: ["recommand"],
    queryFn: getRecommand,
  });

  return { data, isLoading, error };
}

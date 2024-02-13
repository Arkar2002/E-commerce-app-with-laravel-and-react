import { useQuery } from "@tanstack/react-query";
import { getNewArrival } from "../../services/apiHome";

function useNewArrivalProduct() {
  const { data, isLoading, error } = useQuery({
    queryKey: ["newarrival"],
    queryFn: getNewArrival,
  });
  return { data, isLoading, error };
}

export default useNewArrivalProduct;

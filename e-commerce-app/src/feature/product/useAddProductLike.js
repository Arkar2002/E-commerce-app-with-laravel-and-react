import { useMutation, useQueryClient } from "@tanstack/react-query";
import { addProductLike } from "../../services/apiProduct";

export function useAddProductLike() {
  const queryClient = useQueryClient();
  const { mutate, isPending, error } = useMutation({
    mutationFn: addProductLike,
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ["user"] });
      queryClient.invalidateQueries({ queryKey: ["product-likes"] });
    },
  });
  return { mutate, isPending, error };
}

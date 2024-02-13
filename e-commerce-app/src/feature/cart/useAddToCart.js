import { useMutation, useQueryClient } from "@tanstack/react-query";
import { addToCart } from "../../services/apiProduct";

export function useAddToCart() {
  const queryClient = useQueryClient();
  const { mutate, isPending, error } = useMutation({
    mutationFn: addToCart,
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ["user"] });
      queryClient.invalidateQueries({ queryKey: ["carts"] });
    },
  });

  return { mutate, isPending, error };
}

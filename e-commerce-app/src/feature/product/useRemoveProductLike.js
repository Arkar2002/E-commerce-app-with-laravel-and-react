import { useMutation, useQueryClient } from "@tanstack/react-query";
import { removeProductLike } from "../../services/apiProduct";

export function useRemoveProductLike() {
  const queryClient = useQueryClient();
  const { mutate, isPending, error } = useMutation({
    mutationFn: removeProductLike,
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ["user"] });
      queryClient.invalidateQueries({ queryKey: ["product-likes"] });
    },
  });

  return { mutate, isPending, error };
}

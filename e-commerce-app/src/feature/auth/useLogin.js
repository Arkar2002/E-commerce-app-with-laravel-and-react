import { useMutation, useQueryClient } from "@tanstack/react-query";
import { login } from "../../services/apiAuth";

export function useLogin() {
  const queryClient = useQueryClient();
  const { mutate, isPending, error } = useMutation({
    mutationFn: login,
    onSuccess: (data) => {
      queryClient.setQueryData(["user"], data.user);
    },
  });

  return { mutate, isPending, error };
}

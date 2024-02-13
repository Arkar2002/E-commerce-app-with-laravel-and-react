import { useUser } from "../feature/user/useUser";
import { useContextProvider } from "../context/ContextProvider";

export function useUserFromApi() {
  const { token } = useContextProvider();
  const { data, isLoading, refetch } = useUser(token);
  const hasUser = Object.keys(data).length > 0;

  return { data, isLoading, refetch, hasUser };
}

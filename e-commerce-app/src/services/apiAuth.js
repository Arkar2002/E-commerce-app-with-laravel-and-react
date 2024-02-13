import { axiosClient } from "./axiosClient";

export async function login(credentials) {
  const { data } = await axiosClient.post("login", credentials);
  return data;
}

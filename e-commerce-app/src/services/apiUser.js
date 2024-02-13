import { axiosClient } from "./axiosClient";

export async function getUser() {
  const { data: { data } = {} } = await axiosClient.get("user");
  return data;
}

export async function getUserProductLikes() {
  const { data } = await axiosClient.get("product-likes");
  return data;
}

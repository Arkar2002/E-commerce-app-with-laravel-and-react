import { axiosClient } from "./axiosClient";

export async function getCategories() {
  const res = await axiosClient.get("/categories");
  return res.data.data ?? [];
}

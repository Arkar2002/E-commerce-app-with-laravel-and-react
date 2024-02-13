import { axiosClient } from "./axiosClient";

export async function getBrands() {
  const {
    data: { data },
  } = await axiosClient.get("/brands");
  return data || [];
}

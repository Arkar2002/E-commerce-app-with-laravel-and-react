import { axiosClient } from "./axiosClient";

export async function getNewArrival() {
  const { data: { data } = {} } = await axiosClient.get("/newarrival");
  return data;
}

export async function getRecommand() {
  const { data: { data } = {} } = await axiosClient.get("/recommand");
  return data;
}

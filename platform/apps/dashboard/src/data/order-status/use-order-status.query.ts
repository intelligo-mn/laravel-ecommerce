import OrderStatus from "@intelligo/dashboard/repositories/order-status";
import { useQuery } from "react-query";
import { OrderStatus as TOrderStatus } from "@intelligo/dashboard/ts-types/generated";
import { API_ENDPOINTS } from "@intelligo/dashboard/utils/api/endpoints";

export const fetchOrderStatus = async (slug: string) => {
  const { data } = await OrderStatus.find(
    `${API_ENDPOINTS.ORDER_STATUS}/${slug}`
  );
  return data;
};

export const useOrderStatusQuery = (identifier: string) => {
  return useQuery<TOrderStatus, Error>(
    [API_ENDPOINTS.ORDER_STATUS, identifier],
    () => fetchOrderStatus(identifier)
  );
};

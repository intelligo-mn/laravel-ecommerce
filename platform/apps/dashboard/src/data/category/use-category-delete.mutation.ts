import { useMutation, useQueryClient } from "react-query";
import Category from "@intelligo/dashboard/repositories/category";
import { API_ENDPOINTS } from "@intelligo/dashboard/utils/api/endpoints";

export const useDeleteCategoryMutation = () => {
  const queryClient = useQueryClient();

  return useMutation(
    (id: string) => Category.delete(`${API_ENDPOINTS.CATEGORIES}/${id}`),
    {
      // Always refetch after error or success:
      onSettled: () => {
        queryClient.invalidateQueries(API_ENDPOINTS.CATEGORIES);
      },
    }
  );
};

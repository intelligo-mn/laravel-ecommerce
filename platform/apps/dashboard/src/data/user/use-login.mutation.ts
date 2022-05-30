import { LoginInput } from "@intelligo/dashboard/ts-types/generated";
import { useMutation } from "react-query";
import User from "@intelligo/dashboard/repositories/user";
import { API_ENDPOINTS } from "@intelligo/dashboard/utils/api/endpoints";

export interface ILoginVariables {
  variables: LoginInput;
}

export const useLoginMutation = () => {
  return useMutation(({ variables }: ILoginVariables) =>
    User.login(API_ENDPOINTS.TOKEN, variables)
  );
};

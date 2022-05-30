import Card from "@intelligo/dashboard/components/common/card";
import Layout from "@intelligo/dashboard/components/layouts/admin";
import ErrorMessage from "@intelligo/dashboard/components/ui/error-message";
import Loader from "@intelligo/dashboard/components/ui/loader/loader";
import { useTranslation } from "next-i18next";
import { serverSideTranslations } from "next-i18next/serverSideTranslations";
import ShopList from "@intelligo/dashboard/components/shop/shop-list";
import { useState } from "react";
import Search from "@intelligo/dashboard/components/common/search";
import { adminOnly } from "@intelligo/dashboard/utils/auth-utils";
import { useShopsQuery } from "@data/shop/use-shops.query";
import { SortOrder } from "@intelligo/dashboard/ts-types/generated";

export default function AllShopPage() {
  const { t } = useTranslation();
  const [searchTerm, setSearchTerm] = useState("");
  const [page, setPage] = useState(1);
  const [orderBy, setOrder] = useState("created_at");
  const [sortedBy, setColumn] = useState<SortOrder>(SortOrder.Desc);
  const {
    data,
    isLoading: loading,
    error,
  } = useShopsQuery({
    text: searchTerm,
    limit: 10,
    page,
    orderBy,
    sortedBy,
  });

  if (loading) return <Loader text={t("common:text-loading")} />;
  if (error) return <ErrorMessage message={error.message} />;
  function handleSearch({ searchText }: { searchText: string }) {
    setSearchTerm(searchText);
  }
  function handlePagination(current: any) {
    setPage(current);
  }
  return (
    <>
      <Card className="flex flex-col md:flex-row items-center justify-between mb-8">
        <div className="md:w-1/4 mb-4 md:mb-0">
          <h1 className="text-lg font-semibold text-heading">
            {t("common:sidebar-nav-item-shops")}
          </h1>
        </div>

        <div className="w-full md:w-1/2 flex flex-col md:flex-row items-center ms-auto">
          <Search onSearch={handleSearch} />
        </div>
      </Card>
      <ShopList
        shops={data?.shops}
        onPagination={handlePagination}
        onOrder={setOrder}
        onSort={setColumn}
      />
    </>
  );
}
AllShopPage.authenticate = {
  permissions: adminOnly,
};
AllShopPage.Layout = Layout;

export const getStaticProps = async ({ locale }: any) => ({
  props: {
    ...(await serverSideTranslations(locale, ["table", "common", "form"])),
  },
});

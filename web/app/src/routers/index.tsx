import { createBrowserRouter } from "react-router-dom";
import { ROUTE_LIST } from "../constants/route";
import { Home } from "../pages/Home";

export const router = createBrowserRouter([
  {
    path: ROUTE_LIST.HOME,
    element: <Home />,
  },
]);

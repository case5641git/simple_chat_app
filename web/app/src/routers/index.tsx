import { createBrowserRouter } from "react-router-dom";
import { ROUTE_LIST } from "../constants/route";
import { Home } from "../pages/Home/Home";
import { Register } from "../pages/Register/Register";

export const router = createBrowserRouter([
  {
    path: ROUTE_LIST.HOME,
    element: <Home />,
  },
  {
    path: ROUTE_LIST.REGISTER,
    element: <Register />,
  },
]);

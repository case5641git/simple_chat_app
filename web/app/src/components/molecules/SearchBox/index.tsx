import { InputBox } from "../../atoms/InputBox";
import styles from "./styles.module.css";

type SearchBoxProps = {
  type: "text";
  placeholder: string;
};

export const SearchBox: React.FC<SearchBoxProps> = ({ type, placeholder }) => {
  return (
    <div className={styles.searchbox}>
      <InputBox type={type} placeholder={placeholder} />
    </div>
  );
};

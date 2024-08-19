import styles from "./styles.module.css";

type InputBoxProps = {
  type: "text";
  placeholder: string;
};

export const InputBox: React.FC<InputBoxProps> = ({ type, placeholder }) => {
  return (
    <input className={styles.input} type={type} placeholder={placeholder} />
  );
};

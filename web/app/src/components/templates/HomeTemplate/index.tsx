import React from "react";
import { BaseLayout } from "../../organisms/BaseLayout";
import { ChatArea } from "../../organisms/chatarea";

export const HomeTemplate: React.FC = () => {
  return (
    <BaseLayout>
      <ChatArea />
    </BaseLayout>
  );
};

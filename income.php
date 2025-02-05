<style>
.income-container {
  background: var(--main-dsrk-base, #1e1e1e);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  align-items: center;
  padding: 33px 24px 105px;
}

.header-wrapper {
  align-self: stretch;
  display: flex;
  align-items: center;
  justify-content: start;
  text-transform: capitalize;
  flex-wrap: wrap;
  font: 600 21px Open Sans, sans-serif;
}

.logo {
  aspect-ratio: 5.71;
  object-fit: contain;
  width: 587px;
  align-self: stretch;
  min-width: 240px;
  margin: auto 0;
}

.header-actions {
  align-self: stretch;
  display: flex;
  min-width: 240px;
  min-height: 54px;
  align-items: center;
  gap: 23px;
  justify-content: start;
  flex-wrap: wrap;
  margin: auto 0;
}

.new-income-btn {
  width: 214px;
  border-radius: 4px;
  background: var(--complementaries-compl-opt1, #ffe600);
  box-shadow: 0px 4px 12px 0px rgba(0, 0, 0, 0.04);
  align-self: stretch;
  gap: 8px;
  overflow: hidden;
  color: #000;
  text-align: center;
  margin: auto 0;
  padding: 12px 40px;
}

.history-wrapper {
  align-self: stretch;
  display: flex;
  min-width: 240px;
  padding-bottom: 6px;
  gap: 21px;
  color: #fff;
  width: 248px;
  margin: auto 0;
}

.history-icon {
  aspect-ratio: 1;
  object-fit: contain;
  width: 38px;
  align-self: start;
  margin-top: -6px;
}

.divider {
  background-color: #fffde7;
  align-self: stretch;
  margin-top: 23px;
  width: 100%;
  height: 1px;
  border: 1px solid rgba(255, 253, 231, 1);
}

.title-wrapper {
  margin: 32px 0 0 13px;
  font: 800 60px Open Sans, sans-serif;
}

.title-text-main {
  font-family: Poppins, sans-serif;
  font-weight: 700;
  line-height: 90px;
  color: rgba(255, 253, 231, 1);
}

.title-text-accent {
  font-family: Poppins, sans-serif;
  font-weight: 700;
  line-height: 90px;
  color: rgba(81, 210, 137, 1);
}

.total-box {
  border-radius: 15px;
  background-color: rgba(54, 54, 54, 1);
  display: flex;
  width: 640px;
  max-width: 100%;
  height: 94px;
  margin: 44px 0 0 16px;
}

.content-wrapper {
  width: 558px;
  max-width: 100%;
  margin: 42px 0 0 39px;
}

.content-grid {
  gap: 20px;
  display: flex;
}

.categories-column {
  display: flex;
  flex-direction: column;
  line-height: normal;
  width: 82%;
  margin-left: 0px;
}

.category-list {
  display: flex;
  flex-grow: 1;
  flex-direction: column;
  align-items: start;
  color: #ffe600;
  white-space: nowrap;
  text-transform: capitalize;
  font: 700 30px Open Sans, sans-serif;
}

.category-item {
  margin-left: 18px;
}

.category-box {
  border-radius: 15px;
  background-color: rgba(54, 54, 54, 1);
  align-self: stretch;
  display: flex;
  margin-top: 29px;
  width: 100%;
  height: 100px;
}

.actions-column {
  display: flex;
  flex-direction: column;
  line-height: normal;
  width: 18%;
  margin-left: 20px;
}

.actions-wrapper {
  display: flex;
  width: 100%;
  flex-direction: column;
  align-self: stretch;
  white-space: nowrap;
  text-transform: capitalize;
  margin: auto 0;
  font: 400 21px Open Sans, sans-serif;
}

.edit-btn {
  align-self: start;
  display: flex;
  gap: 3px;
  color: var(--complementaries-compl-opt2, #51d289);
}

.edit-icon {
  aspect-ratio: 1;
  object-fit: contain;
  width: 28px;
  align-self: start;
}

.action-buttons {
  display: flex;
  margin-top: 8px;
  align-items: start;
  gap: 32px;
  color: var(--extras-error, #f44336);
  justify-content: start;
}

.delete-btn {
  width: 95px;
  padding: 0 28px;
}

@media (max-width: 991px) {
  .income-container {
    padding: 0 20px 100px;
  }
  
  .header-wrapper {
    max-width: 100%;
    margin-right: 9px;
  }
  
  .logo {
    max-width: 100%;
  }
  
  .header-actions {
    max-width: 100%;
  }
  
  .new-income-btn {
    padding: 0 20px;
  }
  
  .title-wrapper {
    font-size: 40px;
  }
  
  .total-box {
    margin-top: 40px;
  }
  
  .content-wrapper {
    margin-top: 40px;
  }
  
  .content-grid {
    flex-direction: column;
    align-items: stretch;
    gap: 0px;
  }
  
  .categories-column {
    width: 100%;
  }
  
  .category-list {
    max-width: 100%;
    margin-top: 18px;
    white-space: initial;
  }
  
  .category-item {
    margin-left: 10px;
  }
  
  .actions-column {
    width: 100%;
  }
  
  .actions-wrapper {
    margin-top: 40px;
    white-space: initial;
  }
}
</style>

<div class="income-container">
  <div class="header-wrapper">
    <img class="logo" loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/280134801466b205576672ff3e6623837b34e18977cb4a400902f9a792ff53a8?placeholderIfAbsent=true&apiKey=e0f71086e53c475a8c972a54eb6dce84" alt="Income tracker logo" />
    <div class="header-actions">
      <button class="new-income-btn" tabindex="0">New Income</button>
      <div class="history-wrapper">
        <img class="history-icon" loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/70d738dc3df2e6d877f406f47b587460974733cf822693f34948122f5037ba42?placeholderIfAbsent=true&apiKey=e0f71086e53c475a8c972a54eb6dce84" alt="History icon" />
        <button class="view-history" tabindex="0">View History</button>
      </div>
    </div>
  </div>
  
  <div class="divider"></div>
  
  <div class="title-wrapper">
    <span class="title-text-main">Total</span>
    <span class="title-text-accent">Penny</span>
  </div>
  
  <div class="total-box"></div>
  
  <div class="content-wrapper">
    <div class="content-grid">
      <div class="categories-column">
        <div class="category-list">
          <div class="category-item">Cash</div>
          <div class="category-box"></div>
          <div class="category-item">Savings</div>
          <div class="category-box"></div>
          <div class="category-item">E-Wallet</div>
        </div>
      </div>
      
      <div class="actions-column">
        <div class="actions-wrapper">
          <button class="edit-btn" tabindex="0">
            <img class="edit-icon" loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/994b2c4bc21f62850b8bb2d0149980a074f7eb19b7c4a27517ae709fd7ad3d36?placeholderIfAbsent=true&apiKey=e0f71086e53c475a8c972a54eb6dce84" alt="Edit icon" />
            <span>edit</span>
          </button>
          
          <div class="action-buttons">
            <button class="delete-btn" tabindex="0">Delete</button>
          </div>
          
          <button class="edit-btn" tabindex="0">
            <img class="edit-icon" loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/c2a89c17b6fc4b74613db61cfe3b912ba5e414f941ac8fc5f388dfba9270a1ad?placeholderIfAbsent=true&apiKey=e0f71086e53c475a8c972a54eb6dce84" alt="Edit icon" />
            <span>edit</span>
          </button>
          
          <div class="action-buttons">
            <button class="delete-btn" tabindex="0">Delete</button>
          </div>
          
          <button class="edit-btn" tabindex="0">
            <img class="edit-icon" loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/34286280b3c741e4e36883fbcae310d9f4ccba6bfe379eda9a06492969a72e2b?placeholderIfAbsent=true&apiKey=e0f71086e53c475a8c972a54eb6dce84" alt="Edit icon" />
            <span>edit</span>
          </button>
          
          <div class="action-buttons">
            <button class="delete-btn" tabindex="0">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
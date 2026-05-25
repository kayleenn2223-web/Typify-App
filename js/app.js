/**
 * Typify App - Master Controller (js/app.js)
 * Enhanced Interactivity for Multi-Page Prototype
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log("Typify System: Online.");

    const path_to_root = (window.location.pathname.includes('/pages/')) ? "../../" : "";

    // --- 1. UNIVERSAL UTILITIES ---
    
    const showToast = (title, msg) => {
        const toast = document.getElementById('global-toast-notif');
        const tTitle = document.getElementById('toast-title');
        const tMsg = document.getElementById('toast-message');
        
        if (toast && tTitle && tMsg) {
            tTitle.innerText = title;
            tMsg.innerText = msg;
            toast.style.visibility = 'visible';
            toast.style.opacity = '1';
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.style.visibility = 'hidden', 300);
            }, 3000);
        }
    };

    const openModal = (id) => document.getElementById(id)?.classList.add('active');
    const closeModal = (id) => document.getElementById(id)?.classList.remove('active');

    // Dropdown Handler
    const setupDropdown = (triggerId, dropdownId) => {
        const trigger = document.getElementById(triggerId);
        const dropdown = document.getElementById(dropdownId);
        if (trigger && dropdown) {
            trigger.onclick = (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('active');
            };
            document.addEventListener('click', () => dropdown.classList.remove('active'));
        }
    };

    // --- 2. NAVBAR & TOP-RIGHT WIDGET LOGIC ---

    setupDropdown('top-profile-trigger', 'top-profile-dropdown');

    document.getElementById('btn-go-pro')?.addEventListener('click', () => {
        openModal('modal-go-pro');
    });

    // --- 3. SEARCH FILTERING ---

    const searchInput = document.getElementById('main-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            
            document.querySelectorAll('.book-card').forEach(item => {
                const title = item.querySelector('.book-card__title').innerText.toLowerCase();
                const subtitle = item.querySelector('.book-card__author').innerText.toLowerCase();
                if (title.includes(query) || subtitle.includes(query)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // --- 4. NAVIGATION REDIRECTS (ROUTING) ---

    // Clicking Projects/Notes goes to Editor
    document.querySelectorAll('.clickable-project, .clickable-note').forEach(item => {
        item.addEventListener('click', () => {
            const name = item.getAttribute('data-project') || item.getAttribute('data-note');
            showToast("Opening Editor", `Loading workspace for "${name}"...`);
            setTimeout(() => {
                window.location.href = path_to_root + "pages/dashboard/editor.php";
            }, 1000);
        });
    });

    // Editor Cancel / Back logic
    document.getElementById('btn-editor-cancel')?.addEventListener('click', (e) => {
        e.preventDefault();
        openModal('modal-exit-confirm');
    });

    document.getElementById('btn-modal-exit')?.addEventListener('click', () => {
        window.location.href = path_to_root + "index.php";
    });

    // --- 5. MODAL CLOSE LOGIC ---

    document.querySelectorAll('.closeModal').forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.getAttribute('data-modal');
            closeModal(modalId);
        });
    });

    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) overlay.classList.remove('active');
        });
    });

    // --- 6. PAGE SPECIFIC LOGIC ---

    // Settings Theme Accordion
    const accTrigger = document.getElementById('acc-theme-trigger');
    const accItem = document.getElementById('acc-theme-item');
    if (accTrigger && accItem) {
        accTrigger.onclick = () => accItem.classList.toggle('active');
    }

    // Editor Logic
    const editorContent = document.getElementById('editor-content-input');
    if (editorContent) {
        editorContent.addEventListener('input', () => {
            const text = editorContent.value.trim();
            const words = text ? text.split(/\s+/).length : 0;
            const chars = text.length;
            
            document.getElementById('char-count').innerText = `${chars} Characters`;
            
            const autosaveStatus = document.getElementById('autosave-status');
            if (autosaveStatus) {
                autosaveStatus.innerHTML = '<i class="fas fa-sync fa-spin"></i> Saving...';
                setTimeout(() => {
                    autosaveStatus.innerHTML = '<i class="fas fa-check-circle"></i> Draft Saved';
                }, 800);
            }
        });
    }

    document.getElementById('btn-editor-save')?.onclick = () => showToast("Success", "Draft manual save successful!");
    document.getElementById('btn-close-toast')?.addEventListener('click', () => {
        document.getElementById('global-toast-notif').style.opacity = '0';
    });

    // --- 7. TYPIFY REWARDS & INTERACTIVE STATE SIMULATION ---

    // Elements for Rewards simulation
    const btnClaimStreak = document.getElementById('btn-claim-streak');
    const totalPointsDisplay = document.getElementById('total-points-display');
    const rewardsHistoryList = document.getElementById('rewards-history-list');
    const successToastPoints = document.getElementById('success-toast-points');
    const btnCloseToastPoints = document.getElementById('btn-close-toast-points');
    
    // Streak claiming logic
    if (btnClaimStreak) {
        btnClaimStreak.addEventListener('click', () => {
            if (btnClaimStreak.disabled || btnClaimStreak.classList.contains('claimed')) return;

            // 1. Mark button as claimed
            btnClaimStreak.innerHTML = '<i class="fas fa-check-circle"></i> Bonus Sudah Diklaim';
            btnClaimStreak.style.background = 'rgba(36, 59, 107, 0.15)';
            btnClaimStreak.style.color = '#243b6b';
            btnClaimStreak.style.boxShadow = 'none';
            btnClaimStreak.style.cursor = 'default';
            btnClaimStreak.classList.add('claimed');
            
            // Update status text
            const streakStatusText = document.querySelector('.streak-status-text');
            if (streakStatusText) {
                streakStatusText.innerHTML = 'Selamat! Anda telah mengklaim bonus hari ini. Besok masuk lagi ya!';
            }

            // 2. Animate points balance rolling up (+50 points)
            if (totalPointsDisplay) {
                let startPoints = 2450;
                let targetPoints = 2500;
                let duration = 800; // ms
                let startTime = null;

                const animatePoints = (timestamp) => {
                    if (!startTime) startTime = timestamp;
                    let progress = timestamp - startTime;
                    let currentPoints = Math.min(Math.floor(startPoints + (progress / duration) * (targetPoints - startPoints)), targetPoints);
                    totalPointsDisplay.innerHTML = `${currentPoints.toLocaleString()} <small>Pts</small>`;
                    
                    if (progress < duration) {
                        requestAnimationFrame(animatePoints);
                    }
                };
                requestAnimationFrame(animatePoints);
            }

            // 3. Update Day 5 node state from Current to Completed
            const nodeDay5 = document.getElementById('streak-day-5-node');
            if (nodeDay5) {
                nodeDay5.classList.remove('current', 'pulse-glow');
                nodeDay5.classList.add('completed');
                const circle = nodeDay5.querySelector('.node-circle');
                if (circle) {
                    circle.innerHTML = '<i class="fas fa-check"></i>';
                }
                const label = nodeDay5.querySelector('.node-label');
                if (label) {
                    label.classList.remove('font-bold', 'text-navy');
                }
            }

            // 4. Update Day 6 node state from Locked to Current
            const nodes = document.querySelectorAll('.streak-node');
            nodes.forEach(node => {
                if (node.getAttribute('data-day') === '6') {
                    node.classList.remove('locked');
                    node.classList.add('current', 'pulse-glow');
                    const circle = node.querySelector('.node-circle');
                    if (circle) {
                        circle.innerHTML = '<i class="fas fa-gift"></i>';
                    }
                    const label = node.querySelector('.node-label');
                    if (label) {
                        label.classList.add('font-bold', 'text-navy');
                    }
                    const points = node.querySelector('.node-points');
                    if (points) {
                        points.classList.add('badge-peach');
                    }
                }
            });

            // 5. Update streak badge counter to 6
            const streakCountVal = document.getElementById('streak-count-val');
            if (streakCountVal) {
                streakCountVal.innerText = '6';
            }

            // 6. Dynamically add points ledger log in history list
            if (rewardsHistoryList) {
                const today = new Date();
                const options = { day: 'numeric', month: 'long', year: 'numeric' };
                const formattedDate = today.toLocaleDateString('id-ID', options);

                const newHistoryItem = document.createElement('li');
                newHistoryItem.className = 'history-item fade-in';
                newHistoryItem.style.animation = 'fadeIn 0.5s ease-out forwards';
                newHistoryItem.innerHTML = `
                    <div class="history-icon-wrapper positive">
                        <i class="fas fa-star-of-david"></i>
                    </div>
                    <div class="history-info">
                        <strong>Day 5 Streak Reward</strong>
                        <span>${formattedDate}</span>
                    </div>
                    <span class="history-amount positive">+50 Pts</span>
                `;
                // Insert at the top of the ledger list
                rewardsHistoryList.insertBefore(newHistoryItem, rewardsHistoryList.firstChild);
            }

            // 7. Fire the Success Toast popup (+50 XP & 10 Gems)
            if (successToastPoints) {
                successToastPoints.style.display = 'block';
                // Auto dismiss after 4 seconds
                setTimeout(() => {
                    successToastPoints.style.opacity = '0';
                    setTimeout(() => {
                        successToastPoints.style.display = 'none';
                        successToastPoints.style.opacity = '1';
                    }, 400);
                }, 4000);
            }
        });
    }

    // Success Toast Point close action
    if (btnCloseToastPoints && successToastPoints) {
        btnCloseToastPoints.addEventListener('click', () => {
            successToastPoints.style.display = 'none';
        });
    }

    // Modal controller triggers (From modals.php panel)
    const btnTriggerAddAccount = document.getElementById('btn-trigger-add-account');
    const addAccountModal = document.getElementById('add-account-modal');
    const btnCloseAddAccount = document.getElementById('btn-close-add-account');
    const btnCancelAddAccount = document.getElementById('btn-cancel-add-account');
    const formLinkAccount = document.getElementById('form-link-account');
    
    // Add Account form show/hide actions
    if (btnTriggerAddAccount && addAccountModal) {
        btnTriggerAddAccount.addEventListener('click', () => {
            addAccountModal.style.display = 'flex';
            addAccountModal.style.opacity = '0';
            setTimeout(() => addAccountModal.style.opacity = '1', 50);
        });
    }

    const closeAddAccount = () => {
        if (addAccountModal) {
            addAccountModal.style.opacity = '0';
            setTimeout(() => addAccountModal.style.display = 'none', 300);
        }
    };

    btnCloseAddAccount?.addEventListener('click', closeAddAccount);
    btnCancelAddAccount?.addEventListener('click', closeAddAccount);
    
    // Form submission state validation
    if (formLinkAccount) {
        formLinkAccount.addEventListener('submit', (e) => {
            e.preventDefault();
            const emailInput = document.getElementById('modal-input-email');
            const passInput = document.getElementById('modal-input-pass');
            const syncToggle = document.getElementById('sync-notifications-toggle');

            if (emailInput && passInput) {
                console.log(`Linking account: ${emailInput.value}, sync status: ${syncToggle?.checked}`);
                closeAddAccount();
                
                // Trigger toast popup after account links successfully
                const successToastDemo = document.getElementById('success-toast-demo');
                if (successToastDemo) {
                    const title = successToastDemo.querySelector('h4');
                    const body = successToastDemo.querySelector('p');
                    if (title) title.innerText = 'Akun Berhasil Terhubung!';
                    if (body) body.innerText = `Persona "${emailInput.value}" kini siap digunakan.`;
                    
                    successToastDemo.style.display = 'block';
                    setTimeout(() => {
                        successToastDemo.style.opacity = '0';
                        setTimeout(() => {
                            successToastDemo.style.display = 'none';
                            successToastDemo.style.opacity = '1';
                        }, 400);
                    }, 4000);
                }
                
                // Clear input fields
                emailInput.value = '';
                passInput.value = '';
            }
        });
    }

    // Exit Confirmation Dialog actions
    const btnTriggerExitConfirm = document.getElementById('btn-trigger-exit-confirm');
    const exitConfirmModal = document.getElementById('exit-confirm-modal');
    const btnStaySave = document.getElementById('btn-stay-save');
    const btnExitAnyway = document.getElementById('btn-exit-anyway');

    if (btnTriggerExitConfirm && exitConfirmModal) {
        btnTriggerExitConfirm.addEventListener('click', () => {
            exitConfirmModal.style.display = 'flex';
            exitConfirmModal.style.opacity = '0';
            setTimeout(() => exitConfirmModal.style.opacity = '1', 50);
        });
    }

    const closeExitConfirm = () => {
        if (exitConfirmModal) {
            exitConfirmModal.style.opacity = '0';
            setTimeout(() => exitConfirmModal.style.display = 'none', 300);
        }
    };

    btnStaySave?.addEventListener('click', closeExitConfirm);
    
    if (btnExitAnyway) {
        btnExitAnyway.addEventListener('click', () => {
            closeExitConfirm();
            showToast("Redirecting...", "Returning back to Home dashboard.");
            setTimeout(() => {
                window.location.href = path_to_root + "index.php";
            }, 1000);
        });
    }

    // Success Toast demo manual trigger button
    const btnTriggerSuccessToast = document.getElementById('btn-trigger-success-toast');
    const successToastDemo = document.getElementById('success-toast-demo');
    const btnCloseSuccessToast = document.getElementById('btn-close-success-toast');

    if (btnTriggerSuccessToast && successToastDemo) {
        btnTriggerSuccessToast.addEventListener('click', () => {
            const title = successToastDemo.querySelector('h4');
            const body = successToastDemo.querySelector('p');
            if (title) title.innerText = 'Klaim Berhasil!';
            if (body) body.innerText = '+50 XP & 10 Gems telah ditambahkan.';
            
            successToastDemo.style.display = 'block';
            setTimeout(() => {
                successToastDemo.style.opacity = '0';
                setTimeout(() => {
                    successToastDemo.style.display = 'none';
                    successToastDemo.style.opacity = '1';
                }, 400);
            }, 3000);
        });
    }

    if (btnCloseSuccessToast && successToastDemo) {
        btnCloseSuccessToast.addEventListener('click', () => {
            successToastDemo.style.display = 'none';
        });
    }

    // Styled Switch Toggle slide logs
    const syncToggleCheckbox = document.getElementById('sync-notifications-toggle');
    if (syncToggleCheckbox) {
        syncToggleCheckbox.addEventListener('change', (e) => {
            console.log(`Sync Notifications: ${e.target.checked ? 'ENABLED' : 'DISABLED'}`);
        });
    }
});

